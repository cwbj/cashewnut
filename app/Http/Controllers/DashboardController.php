<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;

use URL;

class DashboardController extends \crocodicstudio\crudbooster\controllers\CBController
{
    public $events;

    public function cbInit() {
        // modul configuration
        /*
        | ---------------------------------------------------------------------- 
        | Add css style at body 
        | ---------------------------------------------------------------------- 
        | css code in the variable 
        | $this->style_css = ".style{....}";
        |
        */
        $this->style_css = "
            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 1.25rem;
            }
            .bg-light {
                background-color: #f8f9fa!important;
            }
            .card {
                border-radius: 15px;
                border: 1pt solid #f8f9fa!;
            }
            .mb-20 {
                margin-bottom: 20px;
            }
            .card-title {
                margin-bottom: .75rem;
                font-weight: bold;
            }
            .table-row{
                cursor:pointer;
            }
            .no-data {
                font-weight: bold;
                top: 195px;
                position: absolute;
                left: 0;
                right: 0;
                margin-left: auto;
                margin-right: auto;
                width: 140px;
                font-size: 20px;
                text-align:center;
            }
            .row .nav>li>a {
                padding: 2px 15px !important;
                font-size: 15px;
            }
        ";

        /*
        | ---------------------------------------------------------------------- 
        | Include css File 
        | ---------------------------------------------------------------------- 
        | URL of your css each array 
        | $this->load_css[] = asset("myfile.css");
        |
        */
        $this->load_css = array();
        $this->load_css[] = asset('vendor/crudbooster/assets/select2/dist/css/select2.min.css');
        $this->load_css[] = "https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.css";
        
        $this->load_css[] = asset('css/custom.css');

        /*
        | ---------------------------------------------------------------------- 
        | Add javascript at body 
        | ---------------------------------------------------------------------- 
        | javascript code in the variable 
        | $this->script_js = "function() { ... }";
        |
        */
        if(CRUDBooster::getCurrentMethod() == "getIndex") {
            $this->script_js = "
                document.addEventListener('DOMContentLoaded', function () {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        themeSystem: 'bootstrap',
                        initialView: 'dayGridMonth',
                        slotMinTime: '8:00:00',
                        slotMaxTime: '19:00:00',
                        selectable: true,
                        events: ".json_encode($this->events).",
                    });
                    calendar.render();
                });
            ";
        } else {
            $this->script_js = "";
        }

        /*
        | ---------------------------------------------------------------------- 
        | Include Javascript File 
        | ---------------------------------------------------------------------- 
        | URL of your javascript each array 
        | $this->load_js[] = asset("myfile.js");
        |
        */
        $this->load_js = array();
        $this->load_js[] = "https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js";

    }
    public function getIndex() {
        //First, Add an auth
        if(CRUDBooster::me() == null) {
            CRUDBooster::redirect(CRUDBooster::adminPath('login'), 'Please login!', 'danger');
            exit();
        }
         
        //Create your own query 
        $data = [];
        $data['page_title'] = 'Dashboard Page';
        $data['orang'] = CRUDBooster::me();

        // hak akses
        $akses = DB::table('cms_privileges')
            ->where('id', $data['orang']->id_cms_privileges)
            ->first();
        $data['hak_akses'] = $akses->name;

        // if($data['orang']->id_cms_privileges!=2) {

        // }

        // counts
        $data['notes_count']            = DB::table('works')->count();
        $data['participants_count']     = DB::table('students')->count();

        // data
        $datas                         = DB::table('works')->get();

        foreach($datas as $dt) {
            $this->datas[] = [
                'title' => $dt->job_type,
                'start' => $dt->created_at,
                'end' => $dt->created_at,
                'url' => URL::to('/').'/admin/works/edit/'.$dt->id,
            ];
        }

        // display data & view
        return $this->view('dashboard', $data);
    }
}
