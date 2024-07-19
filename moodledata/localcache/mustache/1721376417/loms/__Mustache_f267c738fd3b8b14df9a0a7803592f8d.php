<?php

class __Mustache_f267c738fd3b8b14df9a0a7803592f8d extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="loms-breadcrumb-widgets clearfix">
';
        $value = $context->find('settingsmenu');
        $buffer .= $this->section4b2a3de4b77b2cf49d895854fc67cad9($context, $indent, $value);
        $value = $context->find('headeractions');
        $buffer .= $this->sectionEdca1df421b72dff8d5351295b225eaf($context, $indent, $value);
        $value = $context->find('pageheadingbutton');
        $buffer .= $this->sectionC7e34f46468871ce26d2fa30c5fb8811($context, $indent, $value);
        $value = $context->find('courseheader');
        $buffer .= $this->sectionC2ca92ea6010215e746c53587c4e8a4f($context, $indent, $value);
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section4b2a3de4b77b2cf49d895854fc67cad9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div id="loms-settings-menu" class="context-header-settings-menu">
    {{{settingsmenu}}}
    </div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div id="loms-settings-menu" class="context-header-settings-menu">
';
                $buffer .= $indent . '    ';
                $value = $this->resolveValue($context->find('settingsmenu'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEdca1df421b72dff8d5351295b225eaf(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="header-actions-container flex-shrink-0" data-region="header-actions-container">
    <div class="header-action ml-2">{{{.}}}</div>
    </div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div class="header-actions-container flex-shrink-0" data-region="header-actions-container">
';
                $buffer .= $indent . '    <div class="header-action ml-2">';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</div>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC7e34f46468871ce26d2fa30c5fb8811(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div id="page-heading-button">
    {{{pageheadingbutton}}}
    </div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div id="page-heading-button">
';
                $buffer .= $indent . '    ';
                $value = $this->resolveValue($context->find('pageheadingbutton'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC2ca92ea6010215e746c53587c4e8a4f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div id="course-header">
    {{{courseheader}}}
    </div>
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <div id="course-header">
';
                $buffer .= $indent . '    ';
                $value = $this->resolveValue($context->find('courseheader'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
