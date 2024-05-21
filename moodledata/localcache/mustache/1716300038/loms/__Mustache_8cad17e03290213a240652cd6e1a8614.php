<?php

class __Mustache_8cad17e03290213a240652cd6e1a8614 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $value = $context->find('top_header');
        $buffer .= $this->section5b4c9064de90b4a1383f4974a326fdcb($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- Start Navbar Area --> 
';
        $buffer .= $indent . '<div class="navbar-area ';
        $value = $this->resolveValue($context->findDot('output.loms_is_siteadmin'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $buffer .= $indent . '    <div class="mobile-responsive-nav">
';
        $buffer .= $indent . '        <div class="container">
';
        $buffer .= $indent . '            <div class="mobile-responsive-menu">
';
        $value = $context->find('logo_visibility');
        $buffer .= $this->section156f8b4c1c69f777e24b5f7c364618eb($context, $indent, $value);
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="desktop-nav">
';
        $buffer .= $indent . '        <div class="container-fluid">
';
        $buffer .= $indent . '            <nav class="navbar navbar-expand-md navbar-light">
';
        $value = $context->find('logo_visibility');
        $buffer .= $this->section5b2158bc7afddd88cd5c237ae0890935($context, $indent, $value);
        $buffer .= $indent . '                
';
        $buffer .= $indent . '                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
';
        $buffer .= $indent . '                    <div class="others-options pe-0">
';
        $value = $context->find('header_search_bar');
        $buffer .= $this->sectionA9abb2737319f94893affdcdad846a53($context, $indent, $value);
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '                    <ul id="menu-primary-menu" class="navbar-nav ms-auto">
';
        $buffer .= $indent . '                        <!-- custom_menu -->
';
        $buffer .= $indent . '                        ';
        $value = $this->resolveValue($context->findDot('output.custom_menu'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                    </ul>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '                    ';
        $value = $this->resolveValue($context->findDot('output.if_loms_guest_user'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $value = $context->find('isloggedin');
        if (empty($value)) {
            
            $buffer .= $indent . '                        <div class="others-options d-flex align-items-center">
';
            $value = $context->find('header_left_btn_text');
            $buffer .= $this->sectionD8869875adca3f91466bf232ba3e5c28($context, $indent, $value);
            $buffer .= $indent . '
';
            $buffer .= $indent . '                            <div class="option-item">
';
            $buffer .= $indent . '                                ';
            $value = $context->find('header_btn_url');
            $buffer .= $this->section9d095164832767d7f8e38db4f5f8525b($context, $indent, $value);
            $buffer .= '
';
            $buffer .= $indent . '                                ';
            $value = $context->find('header_btn_url');
            if (empty($value)) {
                
                $buffer .= ' <a href="';
                $value = $this->resolveValue($context->find('login_url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="user-btn"> ';
            }
            $buffer .= '
';
            $buffer .= $indent . '                                    <i class="';
            $value = $this->resolveValue($context->find('header_btn_icon'), $context);
            $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
            $buffer .= '"></i>
';
            $buffer .= $indent . '                                </a>
';
            $buffer .= $indent . '                            </div>
';
            $buffer .= $indent . '                        </div>
';
        }
        $buffer .= $indent . '                    
';
        $value = $context->find('isloggedin');
        $buffer .= $this->section828f4930420419714677e876da356783($context, $indent, $value);
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </nav>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="others-option-for-responsive">
';
        $buffer .= $indent . '        <div class="container">
';
        $buffer .= $indent . '            <div class="dot-menu">
';
        $buffer .= $indent . '                <div class="inner">
';
        $buffer .= $indent . '                    <div class="circle circle-one"></div>
';
        $buffer .= $indent . '                    <div class="circle circle-two"></div>
';
        $buffer .= $indent . '                    <div class="circle circle-three"></div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            
';
        $buffer .= $indent . '            <div class="container">
';
        $buffer .= $indent . '                <div class="option-inner">
';
        $buffer .= $indent . '                    <div class="others-options d-flex align-items-center">
';
        $value = $context->find('isloggedin');
        if (empty($value)) {
            
            $value = $context->find('header_left_btn_text');
            $buffer .= $this->sectionD8869875adca3f91466bf232ba3e5c28($context, $indent, $value);
            $buffer .= $indent . '
';
            $buffer .= $indent . '                            <div class="option-item d-none-mobile">
';
            $buffer .= $indent . '                                ';
            $value = $context->find('header_btn_url');
            $buffer .= $this->section9d095164832767d7f8e38db4f5f8525b($context, $indent, $value);
            $buffer .= '
';
            $buffer .= $indent . '                                ';
            $value = $context->find('header_btn_url');
            if (empty($value)) {
                
                $buffer .= ' <a href="';
                $value = $this->resolveValue($context->find('login_url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="user-btn"> ';
            }
            $buffer .= '
';
            $buffer .= $indent . '                                    <i class="';
            $value = $this->resolveValue($context->find('header_btn_icon'), $context);
            $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
            $buffer .= '"></i>
';
            $buffer .= $indent . '                                </a>
';
            $buffer .= $indent . '                            </div>
';
        }
        $buffer .= $indent . '
';
        $value = $context->find('header_search_bar');
        $buffer .= $this->section2a8d500f1703e9a8a199603334a33581($context, $indent, $value);
        $buffer .= $indent . '
';
        $value = $context->find('isloggedin');
        $buffer .= $this->sectionBea208ac9252925b96ea9a4b363d2958($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '                        ';
        $value = $this->resolveValue($context->findDot('output.if_loms_guest_user'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '<!-- End Navbar Area -->
';
        $buffer .= $indent . '
';
        if ($partial = $this->mustache->loadPartial('theme_boost/primary-drawer-mobile')) {
            $buffer .= $partial->renderInternal($context);
        }

        return $buffer;
    }

    private function section95880e4c812be02a4b3c4594d2cf1fbe(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="col-lg-4">
                        <ul class="header-right-content">
                            {{{top_header_right_content}}}
                        </ul>
                    </div>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <div class="col-lg-4">
';
                $buffer .= $indent . '                        <ul class="header-right-content">
';
                $buffer .= $indent . '                            ';
                $value = $this->resolveValue($context->find('top_header_right_content'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                        </ul>
';
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5b4c9064de90b4a1383f4974a326fdcb(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <!-- Start Top Header Area -->
    <div class="top-header-area bg-color-0071dc">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-left-content">
                        <p>{{{top_header_content}}}</p>
                    </div>
                </div>

                {{#top_header_right_content}}
                    <div class="col-lg-4">
                        <ul class="header-right-content">
                            {{{top_header_right_content}}}
                        </ul>
                    </div>
                {{/top_header_right_content}}
            </div>
        </div>
    </div>
    <!-- End Top Header Area -->
 ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <!-- Start Top Header Area -->
';
                $buffer .= $indent . '    <div class="top-header-area bg-color-0071dc">
';
                $buffer .= $indent . '        <div class="container-fluid">
';
                $buffer .= $indent . '            <div class="row align-items-center">
';
                $buffer .= $indent . '                <div class="col-lg-8">
';
                $buffer .= $indent . '                    <div class="header-left-content">
';
                $buffer .= $indent . '                        <p>';
                $value = $this->resolveValue($context->find('top_header_content'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</p>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '
';
                $value = $context->find('top_header_right_content');
                $buffer .= $this->section95880e4c812be02a4b3c4594d2cf1fbe($context, $indent, $value);
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <!-- End Top Header Area -->
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0b244634ba412b72293c92cb88afb0f3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' style="{{{mobile_logo_styles}}}" ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' style="';
                $value = $this->resolveValue($context->find('mobile_logo_styles'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '" ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF833055db258e466fc8a863e59c08f4a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <img src="{{mobile_logo}}" alt="{{sitename}}"  {{#mobile_logo_styles}} style="{{{mobile_logo_styles}}}" {{/mobile_logo_styles}}>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <img src="';
                $value = $this->resolveValue($context->find('mobile_logo'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"  ';
                $value = $context->find('mobile_logo_styles');
                $buffer .= $this->section0b244634ba412b72293c92cb88afb0f3($context, $indent, $value);
                $buffer .= '>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section156f8b4c1c69f777e24b5f7c364618eb(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="logo">
                        <a href="{{{ config.wwwroot }}}/">
                            {{#mobile_logo}}
                                <img src="{{mobile_logo}}" alt="{{sitename}}"  {{#mobile_logo_styles}} style="{{{mobile_logo_styles}}}" {{/mobile_logo_styles}}>
                            {{/mobile_logo}}

                            {{^ mobile_logo }}
                                <h2 {{#mobile_logo_styles}} style="{{{mobile_logo_styles}}}" {{/mobile_logo_styles}}>{{sitename}}</h2>
                            {{/mobile_logo}}
                        </a>
                    </div>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <div class="logo">
';
                $buffer .= $indent . '                        <a href="';
                $value = $this->resolveValue($context->findDot('config.wwwroot'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '/">
';
                $value = $context->find('mobile_logo');
                $buffer .= $this->sectionF833055db258e466fc8a863e59c08f4a($context, $indent, $value);
                $buffer .= $indent . '
';
                $value = $context->find('mobile_logo');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                                <h2 ';
                    $value = $context->find('mobile_logo_styles');
                    $buffer .= $this->section0b244634ba412b72293c92cb88afb0f3($context, $indent, $value);
                    $buffer .= '>';
                    $value = $this->resolveValue($context->find('sitename'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '</h2>
';
                }
                $buffer .= $indent . '                        </a>
';
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF4ae517f1e51da61f377c3a37c32b2b7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' style="{{{logo_styles}}}" ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' style="';
                $value = $this->resolveValue($context->find('logo_styles'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '" ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section90e29cfd260bea9ef48e93a71741741c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            <img src="{{main_logo}}" alt="{{sitename}}"  {{#logo_styles}} style="{{{logo_styles}}}" {{/logo_styles}}>
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                            <img src="';
                $value = $this->resolveValue($context->find('main_logo'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"  ';
                $value = $context->find('logo_styles');
                $buffer .= $this->sectionF4ae517f1e51da61f377c3a37c32b2b7($context, $indent, $value);
                $buffer .= '>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5b2158bc7afddd88cd5c237ae0890935(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <a class="navbar-brand" href="{{{ config.wwwroot }}}/">
                        {{#main_logo}}
                            <img src="{{main_logo}}" alt="{{sitename}}"  {{#logo_styles}} style="{{{logo_styles}}}" {{/logo_styles}}>
                        {{/main_logo}}

                        {{^ main_logo }}
                            <h2  {{#logo_styles}} style="{{{logo_styles}}}" {{/logo_styles}}>{{sitename}}</h2>
                        {{/main_logo}}
                    </a>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <a class="navbar-brand" href="';
                $value = $this->resolveValue($context->findDot('config.wwwroot'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '/">
';
                $value = $context->find('main_logo');
                $buffer .= $this->section90e29cfd260bea9ef48e93a71741741c($context, $indent, $value);
                $buffer .= $indent . '
';
                $value = $context->find('main_logo');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                            <h2  ';
                    $value = $context->find('logo_styles');
                    $buffer .= $this->sectionF4ae517f1e51da61f377c3a37c32b2b7($context, $indent, $value);
                    $buffer .= '>';
                    $value = $this->resolveValue($context->find('sitename'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '</h2>
';
                }
                $buffer .= $indent . '                    </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA9abb2737319f94893affdcdad846a53(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            {{{loms_globalsearch_navbar}}}
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                            ';
                $value = $this->resolveValue($context->find('loms_globalsearch_navbar'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section47b28263b711c182d6733ca5421237c2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' <a href="{{header_left_btn_url}}" class="default-btn"> ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' <a href="';
                $value = $this->resolveValue($context->find('header_left_btn_url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="default-btn"> ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD8869875adca3f91466bf232ba3e5c28(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <div class="option-item">
                                    {{#header_left_btn_url}} <a href="{{header_left_btn_url}}" class="default-btn"> {{/header_left_btn_url}}
                                    {{^ header_left_btn_url }} <a href="{{ signup_url }}" class="default-btn"> {{/header_left_btn_url}}
                                        {{header_left_btn_text}}
                                    </a>
                                </div>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <div class="option-item">
';
                $buffer .= $indent . '                                    ';
                $value = $context->find('header_left_btn_url');
                $buffer .= $this->section47b28263b711c182d6733ca5421237c2($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '                                    ';
                $value = $context->find('header_left_btn_url');
                if (empty($value)) {
                    
                    $buffer .= ' <a href="';
                    $value = $this->resolveValue($context->find('signup_url'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '" class="default-btn"> ';
                }
                $buffer .= '
';
                $buffer .= $indent . '                                        ';
                $value = $this->resolveValue($context->find('header_left_btn_text'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '
';
                $buffer .= $indent . '                                    </a>
';
                $buffer .= $indent . '                                </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section9d095164832767d7f8e38db4f5f8525b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' <a href="{{header_btn_url}}" class="user-btn"> ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' <a href="';
                $value = $this->resolveValue($context->find('header_btn_url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="user-btn"> ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section828f4930420419714677e876da356783(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        {{> theme_loms/loms_navbar_user }}
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('theme_loms/loms_navbar_user')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                        ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2a8d500f1703e9a8a199603334a33581(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            <div class="option-item">
                                {{{loms_globalsearch_navbar}}}
                            </div>
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                            <div class="option-item">
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('loms_globalsearch_navbar'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBea208ac9252925b96ea9a4b363d2958(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            {{> theme_loms/loms_navbar_user }}
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('theme_loms/loms_navbar_user')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                            ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
