<?php

/*
 * Copyright 2013-2014 kelsoncm <falecom@kelsoncm.com>, ayrtonricardo <ayrton_jampa15@hotmail.com>.
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

namespace Umbrella\SimpleReport;

use Umbrella\SimpleReport\Api\FieldDefinition;
use Umbrella\SimpleReport\Api\IDatasource;
use Umbrella\SimpleReport\Api\IRenderer;
use Umbrella\SimpleReport\Api\ITemplate;

/**
 * Description of BaseRenderer
 *
 * @author kelsoncm <falecom@kelsoncm.com>
 * @author ayrtonricardo <ayrton_jampa15@hotmail.com>
 */
abstract class BaseRenderer implements IRenderer
{

    protected $configuration;

    /**
     * @var IDatasource 
     */
    protected $datasource;

    /**
     * @var ITemplate 
     */
    protected $template;

    public function __construct(IDatasource $datasource, ITemplate $template)
    {
        $this->datasource = $datasource;
        $this->template = $template;
        $configurationLoader = ConfigurationLoader::getInstance();
        $this->configuration = $configurationLoader->getConfiguration();
    }

    protected function getOption($optionName)
    {
        return $this->configuration->getOption("simpletablereport.{$optionName}");
    }

    protected function getValue(IDatasource $datasource, FieldDefinition $fieldDescription, $rendererPrefix)
    {
        $fieldTypeInstance = $fieldDescription->getFieldTypeInstance($rendererPrefix);
        $unformattedFieldValue = $datasource->getFieldValue($fieldDescription);
        return $fieldTypeInstance->render($unformattedFieldValue);
    }

    protected function getColumnCountTotal ($field)
    {
        $countAll = 0;
        foreach ($this->datasource as $key => $fieldData) {
            if (!is_array($field) && isset($this->datasource[$key][$field])) {
                $countAll += $this->datasource[$key][$field];
            } elseif (is_array($field)) {
                $countAll = $field[0];
            }
        }
        return $countAll;
    }
}