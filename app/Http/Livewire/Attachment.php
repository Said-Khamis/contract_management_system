<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Attachment extends Component
{
    public string $attachment_type = "";
    public function render(): View
    {
        return view('attachments.subs._file_attachment');
    }
}
