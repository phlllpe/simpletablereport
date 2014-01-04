<?php

/*
 * Copyright 2014 kelsoncm <falecom@kelsoncm.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Description of HTMLRenderer
 *
 * @author kelsoncm <falecom@kelsoncm.com>
 */
class HTMLRenderer extends BaseRenderer {
    
    public function getOption($optionName) {
        return parent::getOption("htmlrenderer.{$optionName}");
    }
    
    public function render() {
        $this->doWriteDocumentStart();
        $this->renderTable();
        $this->doWriteDocumentEnd();
    }
    
    protected function renderTable() {
        $this->doWriteTableStart();
        $this->renderTableHeader();
        $this->renderTableBody();
        $this->renderTableFooter();
        $this->doWriteTableEnd();
    }
    
    protected function renderTableHeader() {
        $this->doWriteTableHeaderStart();
        $this->doWriteTableHeaderRowStart();
        foreach ($this->template->getFields() as $value) {
            $this->doWriteTableHeaderDataStart();
            echo $value->getFieldCaption();
            $this->doWriteTableHeaderDataEnd();
        }
        $this->doWriteTableHeaderRowEnd();
        $this->doWriteTableHeaderEnd();
    }
    
    protected function renderTableBody() {
        $this->doWriteTableBodyStart();
        $this->renderTableBodyRows();
        $this->doWriteTableBodyEnd();
    }
    
    protected function renderTableBodyRows() {
        $this->datasource->rewind();
        while ($this->datasource->valid()) {
            $this->doWriteTableBodyRowStart();
            $this->renderTableBodyFields();
            $this->doWriteTableBodyRowEnd();
            $this->datasource->next();
        }
    }
    
    protected function renderTableBodyFields() {
        foreach ($this->template->getFields() as $fieldDescription) {
            $this->doWriteTableBodyDataStart();
            echo $this->getValue($this->datasource, $fieldDescription, 'HTML');
            $this->doWriteTableBodyDataEnd();
        }
    }
    
    protected function renderTableFooter() {
        $this->doWriteTableFooterStart();
        $this->doWriteTableFooterRowStart();
        $ds = $this->datasource;
        for ($ds->rewind(); $ds->valid(); $ds->next()) {
            $this->doWriteTableFooterDataStart();
            echo '&nbsp;';
            $this->doWriteTableFooterDataEnd();
        }
        $this->doWriteTableFooterRowEnd();
        $this->doWriteTableFooterEnd();
    }

    protected function doWriteDocumentStart() {
        echo $this->getOption('documentbody.start');
    }
    
    protected function doWriteTableStart() {
        echo $this->getOption('table.start');
    }
    
    protected function doWriteTableHeaderStart() {
        echo $this->getOption('table.head.start');
    }
    
    protected function doWriteTableHeaderRowStart() {
        echo $this->getOption('table.head.row.start');
    }
    
    protected function doWriteTableHeaderDataStart() {
        echo $this->getOption('table.head.data.start');
    }
    
    protected function doWriteTableHeaderDataEnd() {
        echo $this->getOption('table.head.data.end');
    }
    
    protected function doWriteTableHeaderRowEnd() {
        echo $this->getOption('table.head.row.end');
    }
    
    protected function doWriteTableHeaderEnd() {
        echo $this->getOption('table.head.end');
    }
    
    protected function doWriteTableBodyStart() {
        echo $this->getOption('table.body.start');
    }
    
    protected function doWriteTableBodyRowStart() {
        echo $this->getOption('table.body.row.start');
    }
    
    protected function doWriteTableBodyDataStart() {
        echo $this->getOption('table.body.data.start');
    }
    
    protected function doWriteTableBodyDataEnd() {
        echo $this->getOption('table.body.data.end');
    }
    
    protected function doWriteTableBodyRowEnd() {
        echo $this->getOption('table.body.row.end');
    }
    
    protected function doWriteTableBodyEnd() {
        echo $this->getOption('table.body.end');
    }
    
    protected function doWriteTableFooterStart() {
        echo $this->getOption('table.footer.start');
    }
    
    protected function doWriteTableFooterRowStart() {
        echo $this->getOption('table.footer.row.start');
    }
    
    protected function doWriteTableFooterDataStart() {
        echo $this->getOption('table.footer.data.start');
    }
    
    protected function doWriteTableFooterDataEnd() {
        echo $this->getOption('table.footer.data.end');
    }
    
    protected function doWriteTableFooterRowEnd() {
        echo $this->getOption('table.footer.row.end');
    }
    
    protected function doWriteTableFooterEnd() {
        echo $this->getOption('table.footer.end');
    }
    
    protected function doWriteTableEnd() {
        echo $this->getOption('table.end');
    }
    
    protected function doWriteDocumentEnd() {
        echo $this->getOption('documentbody.end');
    }

}