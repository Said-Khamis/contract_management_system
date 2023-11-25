<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class AttachmentContainer extends Component
{

    public string $name;
    public int $count;
    public function mount($name) : void
    {
        $this->fill(['name' => $name, 'count' => 1]);
    }
    public function increment(): void
    {
        $this->count++;
    }
    public function render() : View
    {
        return View('attachments.subs.attachment');
    }
}
