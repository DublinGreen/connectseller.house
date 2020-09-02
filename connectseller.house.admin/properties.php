<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/detail_page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/nested_form_page.php';


    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class propertiesPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`properties`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('status', true),
                    new StringField('category', true),
                    new StringField('type', true),
                    new StringField('name', true),
                    new StringField('description', true),
                    new IntegerField('bedroom', true),
                    new IntegerField('bathroom', true),
                    new IntegerField('price', true),
                    new StringField('address', true),
                    new StringField('land_size_unit', true),
                    new IntegerField('land_size', true),
                    new StringField('state', true),
                    new StringField('street_number', true),
                    new StringField('street_name', true),
                    new StringField('area', true),
                    new StringField('lga', true),
                    new StringField('latitude', true),
                    new StringField('longitude', true),
                    new StringField('private_note', true),
                    new DateTimeField('time_added', true)
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'status', 'status', 'Status'),
                new FilterColumn($this->dataset, 'category', 'category', 'Category'),
                new FilterColumn($this->dataset, 'type', 'type', 'Type'),
                new FilterColumn($this->dataset, 'name', 'name', 'Name'),
                new FilterColumn($this->dataset, 'description', 'description', 'Description'),
                new FilterColumn($this->dataset, 'bedroom', 'bedroom', 'Bedroom'),
                new FilterColumn($this->dataset, 'bathroom', 'bathroom', 'Bathroom'),
                new FilterColumn($this->dataset, 'price', 'price', 'Price'),
                new FilterColumn($this->dataset, 'address', 'address', 'Address'),
                new FilterColumn($this->dataset, 'land_size_unit', 'land_size_unit', 'Land Size Unit'),
                new FilterColumn($this->dataset, 'land_size', 'land_size', 'Land Size'),
                new FilterColumn($this->dataset, 'state', 'state', 'State'),
                new FilterColumn($this->dataset, 'street_number', 'street_number', 'Street Number'),
                new FilterColumn($this->dataset, 'street_name', 'street_name', 'Street Name'),
                new FilterColumn($this->dataset, 'area', 'area', 'Area'),
                new FilterColumn($this->dataset, 'lga', 'lga', 'Lga'),
                new FilterColumn($this->dataset, 'latitude', 'latitude', 'Latitude'),
                new FilterColumn($this->dataset, 'longitude', 'longitude', 'Longitude'),
                new FilterColumn($this->dataset, 'private_note', 'private_note', 'Private Note'),
                new FilterColumn($this->dataset, 'time_added', 'time_added', 'Time Added')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['status'])
                ->addColumn($columns['category'])
                ->addColumn($columns['type'])
                ->addColumn($columns['name'])
                ->addColumn($columns['description'])
                ->addColumn($columns['bedroom'])
                ->addColumn($columns['bathroom'])
                ->addColumn($columns['price'])
                ->addColumn($columns['address'])
                ->addColumn($columns['land_size_unit'])
                ->addColumn($columns['land_size'])
                ->addColumn($columns['state'])
                ->addColumn($columns['street_number'])
                ->addColumn($columns['street_name'])
                ->addColumn($columns['area'])
                ->addColumn($columns['lga'])
                ->addColumn($columns['latitude'])
                ->addColumn($columns['longitude'])
                ->addColumn($columns['private_note'])
                ->addColumn($columns['time_added']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for category field
            //
            $column = new TextViewColumn('category', 'category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'Type', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_description_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for bedroom field
            //
            $column = new NumberViewColumn('bedroom', 'bedroom', 'Bedroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for bathroom field
            //
            $column = new NumberViewColumn('bathroom', 'bathroom', 'Bathroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for price field
            //
            $column = new NumberViewColumn('price', 'price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_address_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for land_size_unit field
            //
            $column = new TextViewColumn('land_size_unit', 'land_size_unit', 'Land Size Unit', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for land_size field
            //
            $column = new NumberViewColumn('land_size', 'land_size', 'Land Size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_state_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_number_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_name_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_area_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_lga_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_latitude_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_longitude_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_private_note_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for time_added field
            //
            $column = new DateTimeViewColumn('time_added', 'time_added', 'Time Added', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for category field
            //
            $column = new TextViewColumn('category', 'category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_description_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for bedroom field
            //
            $column = new NumberViewColumn('bedroom', 'bedroom', 'Bedroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for bathroom field
            //
            $column = new NumberViewColumn('bathroom', 'bathroom', 'Bathroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for price field
            //
            $column = new NumberViewColumn('price', 'price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_address_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for land_size_unit field
            //
            $column = new TextViewColumn('land_size_unit', 'land_size_unit', 'Land Size Unit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for land_size field
            //
            $column = new NumberViewColumn('land_size', 'land_size', 'Land Size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_state_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_number_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_name_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_area_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_lga_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_latitude_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_longitude_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_private_note_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for time_added field
            //
            $column = new DateTimeViewColumn('time_added', 'time_added', 'Time Added', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for status field
            //
            $editor = new ComboBox('status_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('OFF MARKET', 'OFF MARKET');
            $editor->addChoice('ON MARKET', 'ON MARKET');
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for category field
            //
            $editor = new ComboBox('category_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('HOT DEAL', 'HOT DEAL');
            $editor->addChoice('SALE', 'SALE');
            $editor->addChoice('RENT', 'RENT');
            $editor->addChoice('MORTGAGE', 'MORTGAGE');
            $editColumn = new CustomEditColumn('Category', 'category', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('FULLY DETACHED', 'FULLY DETACHED');
            $editor->addChoice('SEMI DETACHED', 'SEMI DETACHED');
            $editor->addChoice('TERRACES', 'TERRACES');
            $editor->addChoice('TOWN HOUSES', 'TOWN HOUSES');
            $editor->addChoice('BUNGALOW', 'BUNGALOW');
            $editor->addChoice('FLATS', 'FLATS');
            $editor->addChoice('LAND', 'LAND');
            $editColumn = new CustomEditColumn('Type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for bedroom field
            //
            $editor = new TextEdit('bedroom_edit');
            $editColumn = new CustomEditColumn('Bedroom', 'bedroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for bathroom field
            //
            $editor = new TextEdit('bathroom_edit');
            $editColumn = new CustomEditColumn('Bathroom', 'bathroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for price field
            //
            $editor = new TextEdit('price_edit');
            $editColumn = new CustomEditColumn('Price', 'price', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextAreaEdit('address_edit', 50, 8);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for land_size_unit field
            //
            $editor = new ComboBox('land_size_unit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sq Ft', 'Sq Ft');
            $editor->addChoice('hectares', 'hectares');
            $editor->addChoice('acres', 'acres');
            $editor->addChoice('perches', 'perches');
            $editor->addChoice('Sq M', 'Sq M');
            $editColumn = new CustomEditColumn('Land Size Unit', 'land_size_unit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for land_size field
            //
            $editor = new TextEdit('land_size_edit');
            $editColumn = new CustomEditColumn('Land Size', 'land_size', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for state field
            //
            $editor = new TextAreaEdit('state_edit', 50, 8);
            $editColumn = new CustomEditColumn('State', 'state', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for street_number field
            //
            $editor = new TextAreaEdit('street_number_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Number', 'street_number', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for street_name field
            //
            $editor = new TextAreaEdit('street_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Name', 'street_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for area field
            //
            $editor = new TextAreaEdit('area_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area', 'area', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lga field
            //
            $editor = new TextAreaEdit('lga_edit', 50, 8);
            $editColumn = new CustomEditColumn('Lga', 'lga', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for latitude field
            //
            $editor = new TextAreaEdit('latitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Latitude', 'latitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for longitude field
            //
            $editor = new TextAreaEdit('longitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Longitude', 'longitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for private_note field
            //
            $editor = new TextAreaEdit('private_note_edit', 50, 8);
            $editColumn = new CustomEditColumn('Private Note', 'private_note', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for time_added field
            //
            $editor = new DateTimeEdit('time_added_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Time Added', 'time_added', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $editColumn->setAllowListCellEdit(false);
            $editColumn->setAllowSingleViewCellEdit(false);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for status field
            //
            $editor = new ComboBox('status_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('OFF MARKET', 'OFF MARKET');
            $editor->addChoice('ON MARKET', 'ON MARKET');
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for category field
            //
            $editor = new ComboBox('category_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('HOT DEAL', 'HOT DEAL');
            $editor->addChoice('SALE', 'SALE');
            $editor->addChoice('RENT', 'RENT');
            $editor->addChoice('MORTGAGE', 'MORTGAGE');
            $editColumn = new CustomEditColumn('Category', 'category', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('FULLY DETACHED', 'FULLY DETACHED');
            $editor->addChoice('SEMI DETACHED', 'SEMI DETACHED');
            $editor->addChoice('TERRACES', 'TERRACES');
            $editor->addChoice('TOWN HOUSES', 'TOWN HOUSES');
            $editor->addChoice('BUNGALOW', 'BUNGALOW');
            $editor->addChoice('FLATS', 'FLATS');
            $editor->addChoice('LAND', 'LAND');
            $editColumn = new CustomEditColumn('Type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for bedroom field
            //
            $editor = new TextEdit('bedroom_edit');
            $editColumn = new CustomEditColumn('Bedroom', 'bedroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for bathroom field
            //
            $editor = new TextEdit('bathroom_edit');
            $editColumn = new CustomEditColumn('Bathroom', 'bathroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for price field
            //
            $editor = new TextEdit('price_edit');
            $editColumn = new CustomEditColumn('Price', 'price', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextAreaEdit('address_edit', 50, 8);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for land_size_unit field
            //
            $editor = new ComboBox('land_size_unit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sq Ft', 'Sq Ft');
            $editor->addChoice('hectares', 'hectares');
            $editor->addChoice('acres', 'acres');
            $editor->addChoice('perches', 'perches');
            $editor->addChoice('Sq M', 'Sq M');
            $editColumn = new CustomEditColumn('Land Size Unit', 'land_size_unit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for land_size field
            //
            $editor = new TextEdit('land_size_edit');
            $editColumn = new CustomEditColumn('Land Size', 'land_size', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for state field
            //
            $editor = new TextAreaEdit('state_edit', 50, 8);
            $editColumn = new CustomEditColumn('State', 'state', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for street_number field
            //
            $editor = new TextAreaEdit('street_number_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Number', 'street_number', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for street_name field
            //
            $editor = new TextAreaEdit('street_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Name', 'street_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for area field
            //
            $editor = new TextAreaEdit('area_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area', 'area', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for lga field
            //
            $editor = new TextAreaEdit('lga_edit', 50, 8);
            $editColumn = new CustomEditColumn('Lga', 'lga', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for latitude field
            //
            $editor = new TextAreaEdit('latitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Latitude', 'latitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for longitude field
            //
            $editor = new TextAreaEdit('longitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Longitude', 'longitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for private_note field
            //
            $editor = new TextAreaEdit('private_note_edit', 50, 8);
            $editColumn = new CustomEditColumn('Private Note', 'private_note', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for time_added field
            //
            $editor = new DateTimeEdit('time_added_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Time Added', 'time_added', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for status field
            //
            $editor = new ComboBox('status_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('OFF MARKET', 'OFF MARKET');
            $editor->addChoice('ON MARKET', 'ON MARKET');
            $editColumn = new CustomEditColumn('Status', 'status', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for category field
            //
            $editor = new ComboBox('category_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('HOT DEAL', 'HOT DEAL');
            $editor->addChoice('SALE', 'SALE');
            $editor->addChoice('RENT', 'RENT');
            $editor->addChoice('MORTGAGE', 'MORTGAGE');
            $editColumn = new CustomEditColumn('Category', 'category', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for type field
            //
            $editor = new ComboBox('type_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('FULLY DETACHED', 'FULLY DETACHED');
            $editor->addChoice('SEMI DETACHED', 'SEMI DETACHED');
            $editor->addChoice('TERRACES', 'TERRACES');
            $editor->addChoice('TOWN HOUSES', 'TOWN HOUSES');
            $editor->addChoice('BUNGALOW', 'BUNGALOW');
            $editor->addChoice('FLATS', 'FLATS');
            $editor->addChoice('LAND', 'LAND');
            $editColumn = new CustomEditColumn('Type', 'type', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for name field
            //
            $editor = new TextAreaEdit('name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Name', 'name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for description field
            //
            $editor = new TextAreaEdit('description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'description', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for bedroom field
            //
            $editor = new TextEdit('bedroom_edit');
            $editColumn = new CustomEditColumn('Bedroom', 'bedroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for bathroom field
            //
            $editor = new TextEdit('bathroom_edit');
            $editColumn = new CustomEditColumn('Bathroom', 'bathroom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for price field
            //
            $editor = new TextEdit('price_edit');
            $editColumn = new CustomEditColumn('Price', 'price', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for address field
            //
            $editor = new TextAreaEdit('address_edit', 50, 8);
            $editColumn = new CustomEditColumn('Address', 'address', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for land_size_unit field
            //
            $editor = new ComboBox('land_size_unit_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('Sq Ft', 'Sq Ft');
            $editor->addChoice('hectares', 'hectares');
            $editor->addChoice('acres', 'acres');
            $editor->addChoice('perches', 'perches');
            $editor->addChoice('Sq M', 'Sq M');
            $editColumn = new CustomEditColumn('Land Size Unit', 'land_size_unit', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for land_size field
            //
            $editor = new TextEdit('land_size_edit');
            $editColumn = new CustomEditColumn('Land Size', 'land_size', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for state field
            //
            $editor = new TextAreaEdit('state_edit', 50, 8);
            $editColumn = new CustomEditColumn('State', 'state', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for street_number field
            //
            $editor = new TextAreaEdit('street_number_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Number', 'street_number', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for street_name field
            //
            $editor = new TextAreaEdit('street_name_edit', 50, 8);
            $editColumn = new CustomEditColumn('Street Name', 'street_name', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for area field
            //
            $editor = new TextAreaEdit('area_edit', 50, 8);
            $editColumn = new CustomEditColumn('Area', 'area', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lga field
            //
            $editor = new TextAreaEdit('lga_edit', 50, 8);
            $editColumn = new CustomEditColumn('Lga', 'lga', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for latitude field
            //
            $editor = new TextAreaEdit('latitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Latitude', 'latitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for longitude field
            //
            $editor = new TextAreaEdit('longitude_edit', 50, 8);
            $editColumn = new CustomEditColumn('Longitude', 'longitude', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for private_note field
            //
            $editor = new TextAreaEdit('private_note_edit', 50, 8);
            $editColumn = new CustomEditColumn('Private Note', 'private_note', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for time_added field
            //
            $editor = new DateTimeEdit('time_added_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Time Added', 'time_added', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for category field
            //
            $column = new TextViewColumn('category', 'category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_description_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for bedroom field
            //
            $column = new NumberViewColumn('bedroom', 'bedroom', 'Bedroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for bathroom field
            //
            $column = new NumberViewColumn('bathroom', 'bathroom', 'Bathroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for price field
            //
            $column = new NumberViewColumn('price', 'price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_address_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for land_size_unit field
            //
            $column = new TextViewColumn('land_size_unit', 'land_size_unit', 'Land Size Unit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for land_size field
            //
            $column = new NumberViewColumn('land_size', 'land_size', 'Land Size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_state_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_number_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_name_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_area_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_lga_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_latitude_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_longitude_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_private_note_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for time_added field
            //
            $column = new DateTimeViewColumn('time_added', 'time_added', 'Time Added', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for category field
            //
            $column = new TextViewColumn('category', 'category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_description_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for bedroom field
            //
            $column = new NumberViewColumn('bedroom', 'bedroom', 'Bedroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for bathroom field
            //
            $column = new NumberViewColumn('bathroom', 'bathroom', 'Bathroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for price field
            //
            $column = new NumberViewColumn('price', 'price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_address_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for land_size_unit field
            //
            $column = new TextViewColumn('land_size_unit', 'land_size_unit', 'Land Size Unit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for land_size field
            //
            $column = new NumberViewColumn('land_size', 'land_size', 'Land Size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_state_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_number_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_name_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_area_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_lga_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_latitude_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_longitude_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_private_note_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for time_added field
            //
            $column = new DateTimeViewColumn('time_added', 'time_added', 'Time Added', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for status field
            //
            $column = new TextViewColumn('status', 'status', 'Status', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for category field
            //
            $column = new TextViewColumn('category', 'category', 'Category', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for type field
            //
            $column = new TextViewColumn('type', 'type', 'Type', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_description_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for bedroom field
            //
            $column = new NumberViewColumn('bedroom', 'bedroom', 'Bedroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for bathroom field
            //
            $column = new NumberViewColumn('bathroom', 'bathroom', 'Bathroom', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for price field
            //
            $column = new NumberViewColumn('price', 'price', 'Price', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_address_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for land_size_unit field
            //
            $column = new TextViewColumn('land_size_unit', 'land_size_unit', 'Land Size Unit', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for land_size field
            //
            $column = new NumberViewColumn('land_size', 'land_size', 'Land Size', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_state_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_number_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_street_name_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_area_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_lga_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_latitude_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_longitude_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('propertiesGrid_private_note_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for time_added field
            //
            $column = new DateTimeViewColumn('time_added', 'time_added', 'Time Added', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->setAllowSortingByDialog(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setAllowAddMultipleRecords(false);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(false);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(false);
            $this->setAllowPrintSelectedRecords(false);
            $this->setExportListAvailable(array());
            $this->setExportSelectedRecordsAvailable(array());
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array());
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_description_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_address_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_state_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_number_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_name_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_area_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_lga_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_latitude_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_longitude_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_private_note_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_description_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_address_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_state_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_number_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_name_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_area_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_lga_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_latitude_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_longitude_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_private_note_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_description_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_address_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_state_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_number_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_name_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_area_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_lga_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_latitude_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_longitude_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_private_note_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for name field
            //
            $column = new TextViewColumn('name', 'name', 'Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for description field
            //
            $column = new TextViewColumn('description', 'description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_description_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for address field
            //
            $column = new TextViewColumn('address', 'address', 'Address', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_address_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for state field
            //
            $column = new TextViewColumn('state', 'state', 'State', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_state_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_number field
            //
            $column = new TextViewColumn('street_number', 'street_number', 'Street Number', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_number_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for street_name field
            //
            $column = new TextViewColumn('street_name', 'street_name', 'Street Name', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_street_name_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for area field
            //
            $column = new TextViewColumn('area', 'area', 'Area', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_area_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for lga field
            //
            $column = new TextViewColumn('lga', 'lga', 'Lga', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_lga_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for latitude field
            //
            $column = new TextViewColumn('latitude', 'latitude', 'Latitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_latitude_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for longitude field
            //
            $column = new TextViewColumn('longitude', 'longitude', 'Longitude', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_longitude_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for private_note field
            //
            $column = new TextViewColumn('private_note', 'private_note', 'Private Note', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'propertiesGrid_private_note_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }



    try
    {
        $Page = new propertiesPage("properties", "properties.php", GetCurrentUserPermissionSetForDataSource("properties"), 'UTF-8');
        $Page->SetTitle('Properties');
        $Page->SetMenuLabel('Properties');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("properties"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
