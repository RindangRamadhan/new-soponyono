<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function applClasses()
    {
        // default data value
        $dataDefault = [
            'mainLayoutType' => 'vertical-menu',
            'theme' => 'light',
            'isContentSidebar' => false,
            'pageHeader' => false,
            'bodyCustomClass' => '',
            'navbarBgColor' => 'bg-white',
            'navbarType' => 'fixed',
            'isMenuCollapsed' => false,
            'footerType' => 'static',
            'templateTitle' => '',
            'isCustomizer' => true,
            'isChat' => true,
            'isCardShadow' => true,
            'isScrollTop' => true,
            'defaultLanguage' => 'en',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
            'isReload' => false,
            'isCreate' => false,
            'isCreateModal' => false,
            'isExport' => false,
            'isSave' => false,
            'isBack' => false,
            'permission' => [],
        ];

        //if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($dataDefault, config('custom.custom'));

        // all available option of materialize template
        $allOptions = [
            'mainLayoutType' => array('vertical-menu', 'horizontal-menu', 'vertical-menu-boxicons'),
            'theme' => array('light' => 'light', 'dark' => 'dark', 'semi-dark' => 'semi-dark'),
            'isContentSidebar' => array(false, true),
            'pageHeader' => array(false, true),
            'bodyCustomClass' => '',
            'navbarBgColor' => array('bg-white', 'bg-primary', 'bg-success', 'bg-danger', 'bg-info', 'bg-warning', 'bg-dark'),
            'navbarType' => array('fixed' => 'fixed', 'static' => 'static', 'hidden' => 'hidden'),
            'isMenuCollapsed' => array(false, true),
            'footerType' => array('fixed' => 'fixed', 'static' => 'static', 'hidden' => 'hidden'),
            'templateTitle' => '',
            'isCustomizer' => array(true, false),
            'isChat' => array(true, false),
            'isCardShadow' => array(true, false),
            'isScrollTop' => array(true, false),
            'defaultLanguage' => array('en' => 'en', 'pt' => 'pt', 'fr' => 'fr', 'de' => 'de'),
            'direction' => array('ltr' => 'ltr', 'rtl' => 'rtl'),
            'isReload' => array(true, false),
            'isCreate' => array(true, false),
            'isCreateModal' => array(true, false),
            'isExport' => array(true, false),
            'isSave' => array(true, false),
            'isBack' => array(true, false),
            'permission' => [],
        ];
        // navbar body class array
        $navbarBodyClass = [
            'fixed' => 'navbar-sticky',
            'static' => 'navbar-static',
            'hidden' => 'navbar-hidden',
        ];
        $navbarClass = [
            'fixed' => 'fixed-top',
            'static' => 'navbar-static-top',
            'hidden' => 'd-none',
        ];
        // footer class
        $footerBodyClass = [
            'fixed' => 'fixed-footer',
            'static' => 'footer-static',
            'hidden' => 'footer-hidden',
        ];
        $footerClass = [
            'fixed' => 'footer-sticky',
            'static' => 'footer-static',
            'hidden' => 'd-none',
        ];

        //if any options value empty or wrong in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (gettype($data[$key]) === gettype($dataDefault[$key])) {
                if (is_string($data[$key])) {
                    if (is_array($value)) {

                        $result = array_search($data[$key], $value);
                        if (empty($result)) {
                            $data[$key] = $dataDefault[$key];
                        }
                    }
                }
            } else {
                if (is_string($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_bool($dataDefault[$key])) {
                    $data[$key] = $dataDefault[$key];
                } elseif (is_null($dataDefault[$key])) {
                    is_string($data[$key]) ? $data[$key] = $dataDefault[$key] : '';
                }
            }
        }

        //  above arrary override through dynamic data
        $layoutClasses = [
            'mainLayoutType' => $data['mainLayoutType'],
            'theme' => $data['theme'],
            'isContentSidebar' => $data['isContentSidebar'],
            'pageHeader' => $data['pageHeader'],
            'bodyCustomClass' => $data['bodyCustomClass'],
            'navbarBgColor' => $data['navbarBgColor'],
            'navbarType' => $navbarBodyClass[$data['navbarType']],
            'navbarClass' => $navbarClass[$data['navbarType']],
            'isMenuCollapsed' => $data['isMenuCollapsed'],
            'footerType' => $footerBodyClass[$data['footerType']],
            'footerClass' => $footerClass[$data['footerType']],
            'templateTitle' => $data['templateTitle'],
            'isCustomizer' => $data['isCustomizer'],
            'isChat' => $data['isChat'],
            'isCardShadow' => $data['isCardShadow'],
            'isScrollTop' => $data['isScrollTop'],
            'defaultLanguage' => $data['defaultLanguage'],
            'direction' => $data['direction'],
            'isReload' => $data['isReload'],
            'isCreate' => $data['isCreate'],
            'isCreateModal' => $data['isCreateModal'],
            'isExport' => $data['isExport'],
            'isSave' => $data['isSave'],
            'isBack' => $data['isBack'],
            'permission' => $data['permission'],
        ];

        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        return $layoutClasses;
    }

    // updatesPageConfig function override all configuration of custom.php file as page requirements.
    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        $custom = 'custom';

        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set($demo . '.' . $custom . '.' . $config, $val);
                }
            }
        }
    }

    public static function selectServerSide($request, $model, $url, $menu, $customeButton = [], $takeoutButton = [])
    {
        $count = 0;
        $filter = "";
        $globalFilter = "";
        $orderBy = "";
        $fullTextSerch = "0";

        $year = $request->session()->get('year') ?? date('Y');

        // Searching by Column
        switch ($url) {
            // case "/budgets":
            //     $prefix = $year . '_';
            //     switch ($request->attachment) {
            //         case 'roren-attachment':
            //             $tabel_name = 'budget_plans';
            //             $tabel = $prefix . $tabel_name;
            //             break;
            //         case 'pi-attachment':
            //             $tabel_name = 'budget_plan_pis';
            //             $tabel = $prefix . $tabel_name;
            //             break;
            //         case 'wl-attachment':
            //             $tabel_name = 'work_letters';
            //             $tabel = $prefix . $tabel_name;
            //             $fullTextSerch = '9';
            //             break;
            //     }
            //     break;
            // case "/master-data/assignments":
            //     $prefix = $year . '_';
            //     $tabel = $prefix . 'assignments';
            //     break;
            // case "/master-data/team-works":
            //     $prefix = $year . '_';
            //     $tabel = $prefix . 'team_works';
            //     break;
            // case "/master-data/organizational-structure":
            //     $prefix = $year . '_';
            //     $tabel = $prefix . 'work_units';
            //     break;
            // case "/master-data/users":
            //     $prefix = $year . '_';
            //     $tabel = $prefix . 'users';
            //     break;
            // case "/master-data/research-guidelines":
            //     $prefix = $year . '_';
            //     $tabel = $prefix . 'research_guidelines';
            //     break;
            // case "/master-data/requirement-documents":
            //     $prefix = null;
            //     $tabel = 'requirements_documents';
            //     break;
            default:
                $prefix = null;
                $tabel = null;
        }

        $querysearch = '';
        foreach ($request->input('columns') as $column) {
            $colName = str_replace("__", ".", $column['data']);
            /*cek ada tabel tidak jika count >=2 ada tabel*/
            $cekTabel = explode('.', $colName);
            // dd($cekTabel);
            if (count($cekTabel) >= 2) {
                /*fix jika ada alias*/

                if (strlen($cekTabel[0]) <= 4) {
                    // $colName =  str_replace("mu.",  $prefix ."main_units.", $colName);
                    // $colName =  str_replace("wu.", "work_units.", $colName);
                    // $colName =  str_replace("swu.", "sub_work_units.", $colName);
                    $colName = $colName;
                    $fullTextSerch = '0';
                } else {
                    $colName = $prefix . $colName;
                    $fullTextSerch = '0';
                }

                $key_name = $cekTabel[1];
            } else {
                $key_name = $colName;
                if ($fullTextSerch == '9' || $fullTextSerch == '0') {
                    $fullTextSerch = '0';
                } else {
                    $fullTextSerch = '1';
                }
                // dd($fullTextSerch);
            }

            $limitCek = 4;
            // $fullTextSerch = '0';//buat debug

            if ($column['search']['value']) {
                if ($fullTextSerch == '1' && (strtolower($colName) != 'id' && strtolower($colName) != 'date')) {
                    if ($tabel) {
                        Helper::cekFultextIndex($tabel, $key_name, 'FULLTEXT');
                    }

                    $cekKata = explode(' ', $column['search']['value']);
                    $cariQ = count($cekKata) >= $limitCek ? '\'\"' . $column['search']['value'] . '\"\'' : '\'' . $column['search']['value'] . '\'';
                    $querysearch = ' MATCH(' . strtolower($colName) . ') AGAINST (' . $cariQ . ' IN BOOLEAN MODE) ';
                    // Log::info($column['search']['value'] . '-SAMU-' . $querysearch);
                    $filter .= $count > 0
                    ? " AND " . $querysearch
                    : $querysearch;
                    $count++;
                } else {
                    $filter .= $count > 0
                    ? " AND lower($colName) LIKE '%" . strtolower($column['search']['value']) . "%'"
                    : "lower($colName) LIKE '%" . strtolower($column['search']['value']) . "%'";
                    $count++;
                }
            }

            // Set filter search global
            if ($column['searchable'] == "true") {

                if ($fullTextSerch == '1') {

                    $cekKata = explode('+', $request->input('search.value'));
                    $cariQ = count($cekKata) >= $limitCek ? '\'\"' . $request->input('search.value') . '\"\'' : '\'' . $request->input('search.value') . '\'';
                    /*bug fix kalo tidak ada pencarin kata*/
                    if ($cariQ != "''" && (strtolower($colName) != 'id' || strtolower($colName) != 'date')) {
                        $querysearch = ' MATCH(' . strtolower($colName) . ') AGAINST (' . $cariQ . ' IN NATURAL LANGUAGE MODE) ';
                    } else {
                        $querysearch = '';
                    }
                    // Log::info($request->input('search.value') . '-SAMU-' . $querysearch);
                    $globalFilter .= $globalFilter == ""
                    ? $querysearch
                    : ($querysearch != '' ? " OR " . $querysearch : "");
                } else {
                    $globalFilter .= $globalFilter == ""
                    ? "lower($colName) LIKE '%" . strtolower($request->input('search.value')) . "%'"
                    : " OR lower($colName) LIKE '%" . strtolower($request->input('search.value')) . "%'";
                }
            }
        }

        if (is_string($model)) {
            $recordsTotal = DB::select(" select count(*) as count from (" . $model . ") as vt")[0]->count;
        } else {
            $recordsTotal = $model->count();
        }
        $recordsFiltered = $recordsTotal;

        // Sort
        $column = $request->input('columns')[$request->order[0]['column']]['data'];
        $dir = $request->order[0]['dir'];

        // Seaching Global
        if (!empty($request->input('search.value'))) {
            // dd(1);
            $filter = $globalFilter;
            // Log::info('SAMU-Filter::' . $filter);
            if (is_string($model)) {
                $select = $model . " and " . $filter . " order by " . $column . " " . $dir . " limit " . $request->length . " offset " . $request->start;
                $records = DB::select(" select * from (" . $select . ") as vt");
                $recordsFiltered = DB::select(" select count(*) as count from (" . $select . ") as vt")[0]->count;
            } else {
                $select = $model->whereRaw($filter)
                    ->offset($request->input('start'))
                    ->limit($request->input('length'))
                    ->orderBy("$column", "$dir");

                $records = $select->get();
                $recordsFiltered = $select->count();
            }
        } else {
            // dd(2);

            switch (true) {
                case $count > 0:
                    if (is_string($model)) {
                        $select = $model . " and " . $filter . " order by " . $column . " " . $dir . " limit " . $request->length . " offset " . $request->start;
                        $records = DB::select(" select * from (" . $select . ") as vt");
                    } else {
                        // Log::info('SAMU-FilterElse::' . $filter);
                        $select = $model->whereRaw($filter)
                            ->offset($request->input('start'))
                            ->limit($request->input('length'))
                            ->orderBy("$column", "$dir");

                        $records = $select->get();
                        $recordsFiltered = $select->count();
                    }
                    break;

                default:
                    if (is_string($model)) {
                        $select = $model . " order by " . $column . " " . $dir . " limit " . $request->length . " offset " . $request->start;
                        $records = DB::select(" select * from (" . $select . ") as vt");
                    } else {
                        $records = $model
                            ->offset($request->input('start'))
                            ->limit($request->input('length'))
                            ->orderBy("$column", "$dir")
                            ->get();
                    }
                    break;
            }
        }

        foreach ($records as &$record) {
            $id = $record->id;
            $name = $record->name;
            if(!$name){
                $name = $record->user_name;
            }
            $buttonDownload = "<a href=" . url("$url/$id/download") . " class='btn btn-icon rounded-circle btn-primary btn-download-$id' data-id='$id'><i class='bx bx-download'></i></a>";

            $buttonPdfPreview = Auth::user()->can("$menu-$menu Lihat")
            ? "<a href=" . url("$url/$id/view-doc") . " target='_blank' class='btn btn-icon rounded-circle btn-info'><i class='bx bxs-folder-open'></i></a>"
            : "";

            $buttonDetail = Auth::user()->can("$menu-$menu Lihat")
            ? "<a href=" . url("$url/$id") . " class='btn btn-icon rounded-circle btn-info'><i class='bx bx-list-ul'></i></a>"
            : "";

            $buttonEdit = Auth::user()->can("$menu-$menu Edit")
            ? "<a href=" . url("$url/$id/edit") . " class='btn btn-icon rounded-circle btn-success'><i class='bx bx-edit-alt'></i></a>"
            : "";

            $buttonDelete = Auth::user()->can("$menu-$menu Hapus")
            ? "<button type='button' class='btn btn-icon rounded-circle btn-danger btn-delete' data-id=" . $id . " data-name=".$name."><i class='bx bx-trash'></i></button>"
            : "";

            $record->action = "";
            if (count($customeButton) > 0) {
                foreach ($customeButton as $v) {

                    switch ($v) {
                        case 'download':
                            $record->action .= "$buttonDownload ";
                            break;
                        case 'detail':
                            $record->action .= "$buttonDetail ";
                            break;
                        case 'preview':
                            $record->action .= "$buttonPdfPreview ";
                            break;
                    }
                }
            }

            $record->action .= "$buttonEdit $buttonDelete";

            if (count($takeoutButton) > 0) {
                foreach ($takeoutButton as $v) {

                    switch ($v) {
                        case 'edit':
                            $record->action = str_replace($buttonEdit, "", $record->action);
                            break;
                        case 'delete':
                            $record->action = str_replace($buttonDelete, "", $record->action);
                            break;
                    }
                }
            }
        }

        return [$records, $recordsTotal, $recordsFiltered];
    }

    public static function cekFultextIndex($tabel, $key_name, $index_type)
    {
        $query = 'SHOW INDEX FROM ' . $tabel . ' where Key_name=\'' . $key_name . '\' and Index_type=\'' . $index_type . '\'';
        // dd($query);
        $return = DB::select($query);
        if (count($return) == 0) {
            $query = '
            ALTER TABLE ' . $tabel . '
            ADD FULLTEXT(' . $key_name . ');
            ';
            $return = DB::select($query);
        };

        return $return;
    }

    /**
     * Replace dupplicate value on spesific field
     * between row
     * @param  array  $data
     * @return array  $records
     */
    public static function replaceDupplicateRow($data, ...$fields)
    {
        $records = [];
        $temp_records = json_decode(json_encode($data, true));

        for ($i = 0; $i < count($temp_records); $i++) {
            $object = $data[$i];

            if ($i > 0) {
                $x = $i - 1;

                foreach ($fields as $field) {
                    $new_name = ($temp_records[$i]->$field != $temp_records[$x]->$field)
                    ? $temp_records[$i]->$field
                    : "";

                    $object->$field = $new_name;
                }
            }

            $records[] = $object;
        }

        return $records;
    }

    public static function buildTreeView($data)
    {
        $result = [];
        $children = [];

        foreach ($data as $obj) {
            $children[$obj->parent][] = $obj->text;
            $data[$obj->text] = $obj;
        }

        $setChild = function (&$array, $parents) use (&$setChild, $data, $children) {
            foreach ($parents as $parent) {
                $temp = $data[$parent];

                if (isset($children[$parent])) {
                    $temp->children = [];
                    $setChild($temp->children, $children[$parent]);
                }

                $array[] = $temp;
            }
        };

        $setChild($result, $children['']);

        return $result;
    }

    public static function UserType()
    {
        return [
            [
                "id" => "UID",
                "text" => "UID",
            ],
            [
                "id" => "UP3",
                "text" => "UP3",
            ],
            [
                "id" => "UP2D",
                "text" => "UP2D",
            ],
            [
                "id" => "UP2K",
                "text" => "UP2K",
            ],
            [
                "id" => "ULP",
                "text" => "ULP",
            ],
        ];
    }
}
