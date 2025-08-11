<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class Breadcrumb extends Component {
    public $title = "";
    public $favicon = "";

    public function __construct($title){
        $settings = Setting::first() ?? (object) array("brand_name" => "", "software_favicon" => "");
        $this->title = $settings->brand_name ?? $title;
        $this->favicon = $settings->software_favicon;
    }

    public function render(){
        return view('components.breadcrumb',['title' => $this->title,'favicon' => $this->favicon]);
    }
}
