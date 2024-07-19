<?php

class __Mustache_b1cc6658b5f5db250ab3cc1dcc376986 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<ul class="loms-header-user-sec pull-right">
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->findDot('output.edit_switch'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->findDot('output.navbar_plugin_output'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '    
';
        $value = $context->find('primarymoremenu');
        $buffer .= $this->sectionCbebdeb4342dc23cdcbc401ea3cc5493($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <li class="user_setting">
';
        $buffer .= $indent . '        <div class="dropdown">
';
        $buffer .= $indent . '            <a class="btn dropdown-toggle loms-profile-menu" href="#" data-toggle="dropdown" aria-expanded="false"><img class="rounded-circle" src="';
        $value = $this->resolveValue($context->find('user_profile_picture'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '" alt="';
        $value = $this->resolveValue($context->find('user_username'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '"></a>
';
        $buffer .= $indent . '            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(-9px, -5px, 0px); left: 0px; will-change: transform;">
';
        $buffer .= $indent . '            <div class="user_set_header">
';
        $buffer .= $indent . '                <img class="float-left rounded-circle" src="';
        $value = $this->resolveValue($context->find('user_profile_picture'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '" alt="';
        $value = $this->resolveValue($context->find('profile_icon_username'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '">
';
        $buffer .= $indent . '                <p>';
        $value = $this->resolveValue($context->find('profile_icon_username'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= ' <br><span class="address">';
        $value = $this->resolveValue($context->find('user_email'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '</span></p>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="user_setting_content">
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->findDot('output.user_menu'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </li>
';
        $buffer .= $indent . '</ul>';

        return $buffer;
    }

    private function sectionCbebdeb4342dc23cdcbc401ea3cc5493(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <li class="user_setting loms-settings-nav">
            <div class="dropdown">
                <a class="notification-icon" href="{{{ config.wwwroot }}}/admin/search.php"><i class=\'icon bx bx-cog\'></i></a>
            </div>
        </li>
    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <li class="user_setting loms-settings-nav">
';
                $buffer .= $indent . '            <div class="dropdown">
';
                $buffer .= $indent . '                <a class="notification-icon" href="';
                $value = $this->resolveValue($context->findDot('config.wwwroot'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '/admin/search.php"><i class=\'icon bx bx-cog\'></i></a>
';
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
