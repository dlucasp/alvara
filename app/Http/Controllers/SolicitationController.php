<?php

namespace App\Http\Controllers;

use App\Model\Document;
use App\Model\Movimentation;
use App\Model\Solicitation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SolicitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $query = Solicitation::query();
        $q = request('q') ?? null;
        if (request()->has('q') || auth()->user()->nivel == 'user') {
            $query->where('protocol', '=', $q);
            $query->orWhere('document', '=', $q);
        }

        $solicitations = $query->paginate(10);
        return view('solicitation.index', compact('solicitations'));
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'document' => 'required'
        ]);

        $solicitation = new Solicitation(request()->all());
        $solicitation->user_id = auth()->id();
        $solicitation->status = "ABERTO";
        $solicitation->protocol = date('Y') . "/" . Carbon::now()->timestamp . rand(0, 9);
        $solicitation->save();

        return redirect()->route('solicitation.show', [$solicitation])->with("success", 'Solicitação Iniciado com sucesso');
    }

    public function show(Solicitation $solicitation)
    {
        return view('solicitation.show', compact('solicitation'));

    }

    public function uploadDocument(Solicitation $solicitation)
    {
        $validatedData = request()->validate([
            'file' => 'mimes:jpeg,bmp,png,gif,svg,pdf'
        ]);
        dd($validatedData, request()->all());

        $filename = Storage::put("anexos", request()->file);

        $document = new Document();
        $document->fill(array(
            'solicitation_id' => $solicitation->id,
            'file_name' => $filename,
            'description' => "Sem descrição",
            'user_id' => null,
            'downloaded' => false,
            'download_date' => null,
            'approved' => null,
            'observation' => null,
            'annotation' => null,
        ));
        $document->save();
        return redirect()->route('solicitation.show', [$solicitation])->with("success", 'Solicitação Iniciado com sucesso');
    }

    public function addAnnotation(Solicitation $solicitation)
    {
        $movimentation = new Movimentation();
        $movimentation->fill(array(
            'solicitation_id' => $solicitation->id,
            'user_id' => auth()->id(),
            'status' => request('status'),
            'observation' => '',
            'annotation' => request('annotation'),
            'is_public' => true,
        ));
        $movimentation->save();
        $solicitation->status = request('status');
        $solicitation->save();
        return redirect()->route('solicitation.show', [$solicitation])->with("success", 'Movimentação efetuada com sucesso');
    }

    public function download(Solicitation $solicitation, Document $document)
    {
        if (auth()->user()->nivel == 'admin' && !$document->downloaded) {
            $document->downloaded = true;
            $document->download_date = Carbon::now();
            $document->user_id = auth()->id();
            $document->save();
        }

        return Storage::download($document->file_name);
    }

    public function approve(Solicitation $solicitation, Document $document)
    {
        $document->approved = request('approve');
        if ($document->save()) {
            if ($document->approved)
                $annotation = "Aprovado Documento $document->id";
            else
                $annotation = "Reprovado Documento $document->id";
            $movimentation = new Movimentation();
            $movimentation->fill(array(
                'solicitation_id' => $solicitation->id,
                'user_id' => auth()->id(),
                'status' => $solicitation->status,
                'observation' => '',
                'annotation' => $annotation,
                'is_public' => true,
            ));
            $movimentation->save();
        }

        return redirect()->route('solicitation.show', [$solicitation]);
    }
}
