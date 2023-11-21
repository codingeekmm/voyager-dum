<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        //Data Type
        $dataType = $this->dataType('name', 'companies');
        if (!$dataType->exists) {
            $dataType->fill([
                'slug'                  => 'companies',
                'display_name_singular' => 'Company',
                'display_name_plural'   => 'Companies',
                'icon'                  => 'voyager-companies',
                'model_name'            => 'App\\Models\\Company',
                'controller'            => 'App\\Http\\Controllers\\CompanyController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
        //Data Rows
        $companyDataType = DataType::where('slug', 'companies')->firstOrFail();
        $dataRow = $this->dataRow($companyDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }



        $dataRow = $this->dataRow($companyDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 4,
            ])->save();
        }



        $dataRow = $this->dataRow($companyDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.created_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($companyDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => __('voyager::seeders.data_rows.updated_at'),
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 7,
            ])->save();
        }

        //Menu Item
        $menu = Menu::where('name', 'admin')->firstOrFail();
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Companies',
            'url'     => '',
            'route'   => 'voyager.companies.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-companies',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 8,
            ])->save();
        }

        //Permissions
        Permission::generateFor('companies');

        //Content
        $company = Company::firstOrNew([
            'name' => 'company-1',
        ]);
        if (!$company->exists) {
            $company->fill([
                'name' => 'Company 1',
            ])->save();
        }

        $company = Company::firstOrNew([
            'name' => 'company-2',
        ]);
        if (!$company->exists) {
            $company->fill([
                'name' => 'Company 2',
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
