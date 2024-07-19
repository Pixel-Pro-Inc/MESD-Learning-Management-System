<?php

class __Mustache_cdf6412fe2b383dd28d434089c0c6f34 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<li class="user-notif loms-settings-nav loms-settings-nav-notif">
';
        $buffer .= $indent . '    <div class="dropdown">
';
        $buffer .= $indent . '        <div class="popover-region collapsed ';
        $blockFunction = $context->findInBlock('classes');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '" ';
        $blockFunction = $context->findInBlock('attributes');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= ' data-region="popover-region">
';
        $buffer .= $indent . '            <div class="popover-region-toggle nav-link" data-region="popover-region-toggle" role="button" aria-controls="popover-region-container-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" aria-haspopup="true" aria-label="';
        $blockFunction = $context->findInBlock('togglelabel');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        } else {
            $value = $context->find('str');
            $buffer .= $this->section8b664e6398e53f993cf581dd926d5784($context, $indent, $value);
        }
        $buffer .= '"
';
        $buffer .= $indent . '                tabindex="0">
';
        $buffer .= $indent . '                <div class="notification-icon">';
        $blockFunction = $context->findInBlock('togglecontent');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '</div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div ';
        $blockFunction = $context->findInBlock('containerattributes');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= ' id="popover-region-container-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" class="popover-region-container" data-region="popover-region-container" aria-expanded="false" aria-hidden="true"
';
        $buffer .= $indent . '            aria-label="';
        $blockFunction = $context->findInBlock('containerlabel');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '" role="region">
';
        $buffer .= $indent . '                <div class="--popover-region-header-container so_heading">
';
        $buffer .= $indent . '                    <p class="--popover-region-header-text" data-region="popover-region-header-text">';
        $blockFunction = $context->findInBlock('headertext');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '</p>
';
        $buffer .= $indent . '                    <div class="popover-region-header-actions" data-region="popover-region-header-actions">';
        $blockFunction = $context->findInBlock('headeractions');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '</div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="popover-region-content-container" data-region="popover-region-content-container">
';
        $buffer .= $indent . '                    <div class="popover-region-content" data-region="popover-region-content">
';
        $buffer .= $indent . '                        ';
        $blockFunction = $context->findInBlock('content');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        }
        $buffer .= '
';
        $buffer .= $indent . '                    </div>
';
        if ($partial = $this->mustache->loadPartial('core/loading')) {
            $buffer .= $partial->renderInternal($context, $indent . '                    ');
        }
        $buffer .= $indent . '                </div>
';
        $blockFunction = $context->findInBlock('anchor');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        } else {
            $value = $context->findDot('urls.seeall');
            $buffer .= $this->section7d5bde3be6f3764bc3ba0cfca5f0838e($context, $indent, $value);
        }
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</li>';

        return $buffer;
    }

    private function section8b664e6398e53f993cf581dd926d5784(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'showpopovermenu';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'showpopovermenu';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section560076495ba24e041d1e004b36f2b0d1(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' seeall, message ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' seeall, message ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7d5bde3be6f3764bc3ba0cfca5f0838e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <a class="see-all-link view_all_noti text-thm" href="{{{.}}}">
                    <div class="loms--popover-region-footer-container">
                        <div class="popover-region-seeall-text">{{#str}} seeall, message {{/str}}</div>
                    </div>
                </a>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <a class="see-all-link view_all_noti text-thm" href="';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '">
';
                $buffer .= $indent . '                    <div class="loms--popover-region-footer-container">
';
                $buffer .= $indent . '                        <div class="popover-region-seeall-text">';
                $value = $context->find('str');
                $buffer .= $this->section560076495ba24e041d1e004b36f2b0d1($context, $indent, $value);
                $buffer .= '</div>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
