<?php

class __Mustache_71a985fbc40e2c0b375065f63cfe5990 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="footer-area bg-color-f5faff pt-100 pb-70">
';
        $buffer .= $indent . '    <div class="container">
';
        $buffer .= $indent . '        <div class="row">
';
        $buffer .= $indent . '            <div class="col-lg-4 col-sm-12 wow animate__animated animate__fadeInUp delay-0-2s">
';
        $buffer .= $indent . '                <div class="single-footer-widget pr-40">
';
        $value = $context->find('footer_logo_visibility');
        $buffer .= $this->sectionF588fbcf24d74482d109fab5827f9ead($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '                    <p>';
        $value = $this->resolveValue($context->find('footer_info'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '</p>
';
        $buffer .= $indent . '                    <ul class="footer-social">
';
        if ($partial = $this->mustache->loadPartial('theme_loms/loms_social_icons')) {
            $buffer .= $partial->renderInternal($context, $indent . '                        ');
        }
        $buffer .= $indent . '                    </ul>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <div class="col-lg-8">
';
        $buffer .= $indent . '                <div class="row">
';
        $value = $context->find('footer_column_1');
        $buffer .= $this->section8048373a941518fdae0db1e3e4e9feb1($context, $indent, $value);
        $buffer .= $indent . '
';
        $value = $context->find('footer_column_2');
        $buffer .= $this->section4f6fecb306718d19a6a723eb081cc6a0($context, $indent, $value);
        $value = $context->find('footer_column_3');
        $buffer .= $this->sectionC8825d3d051a552095c46ba22496bfaf($context, $indent, $value);
        $value = $context->find('footer_column_4');
        $buffer .= $this->sectionB648c751c81a64e58c64586388c5e740($context, $indent, $value);
        $value = $context->find('footer_column_5');
        $buffer .= $this->sectionE7c736d59b39dd8ead6eed39bb8ec27c($context, $indent, $value);
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $value = $context->find('footer_shape_img1');
        $buffer .= $this->sectionD35ebfcab2355297fb4c80a237f35c72($context, $indent, $value);
        $buffer .= $indent . '
';
        $value = $context->find('footer_shape_img2');
        $buffer .= $this->section128a09856eee7fa2d27c290bfbe84a4a($context, $indent, $value);
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- Copyright Area -->
';
        $value = $this->resolveValue($context->findDot('output.get_footer_bottom'), $context);
        $buffer .= $indent . ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '
';
        $value = $context->find('back_to_top');
        $buffer .= $this->section7e37250511d419f86a222996c58d565d($context, $indent, $value);
        $buffer .= $indent . '
';
        $value = $this->resolveValue($context->findDot('output.standard_end_of_body_html'), $context);
        $buffer .= $indent . ($value === null ? '' : $value);

        return $buffer;
    }

    private function section06311a8a65a3ef6d057bc27a0fc91b30(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' style="{{{footer_logo_styles}}}" ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= ' style="';
                $value = $this->resolveValue($context->find('footer_logo_styles'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '" ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1467f44b81f081aa2c6d0fabe89f0f99(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <img src="{{main_footer_logo}}" alt="{{sitename}}"  {{#footer_logo_styles}} style="{{{footer_logo_styles}}}" {{/footer_logo_styles}}>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <img src="';
                $value = $this->resolveValue($context->find('main_footer_logo'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"  ';
                $value = $context->find('footer_logo_styles');
                $buffer .= $this->section06311a8a65a3ef6d057bc27a0fc91b30($context, $indent, $value);
                $buffer .= '>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF588fbcf24d74482d109fab5827f9ead(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <a class="logo" href="{{{ config.wwwroot }}}/">
                            {{#main_footer_logo}}
                                <img src="{{main_footer_logo}}" alt="{{sitename}}"  {{#footer_logo_styles}} style="{{{footer_logo_styles}}}" {{/footer_logo_styles}}>
                            {{/main_footer_logo}}

                            {{^ main_footer_logo }}
                                <h2  {{#footer_logo_styles}} style="{{{footer_logo_styles}}}" {{/footer_logo_styles}}>{{sitename}}</h2>
                            {{/main_footer_logo}}
                        </a>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <a class="logo" href="';
                $value = $this->resolveValue($context->findDot('config.wwwroot'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '/">
';
                $value = $context->find('main_footer_logo');
                $buffer .= $this->section1467f44b81f081aa2c6d0fabe89f0f99($context, $indent, $value);
                $buffer .= $indent . '
';
                $value = $context->find('main_footer_logo');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                                <h2  ';
                    $value = $context->find('footer_logo_styles');
                    $buffer .= $this->section06311a8a65a3ef6d057bc27a0fc91b30($context, $indent, $value);
                    $buffer .= '>';
                    $value = $this->resolveValue($context->find('sitename'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '</h2>
';
                }
                $buffer .= $indent . '                        </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section28774e105ea13c869f416e184be39b22(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                    <h3>{{{ footer_col_1_title }}}</h3>
                                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                    <h3>';
                $value = $this->resolveValue($context->find('footer_col_1_title'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</h3>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5ecacff1e380add0c0bd650f2484c5df(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                    {{{footer_col_1_body}}}
                                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                    ';
                $value = $this->resolveValue($context->find('footer_col_1_body'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8048373a941518fdae0db1e3e4e9feb1(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="{{{footer_col_1_class}}} col-lg-4 col-sm-6 wow animate__animated animate__fadeInUp delay-0-4s">
                            <div class="single-footer-widget">

                                {{#footer_col_1_title}}
                                    <h3>{{{ footer_col_1_title }}}</h3>
                                {{/footer_col_1_title}}

                                {{#footer_col_1_body}}
                                    {{{footer_col_1_body}}}
                                {{/footer_col_1_body}}
                            </div>
                        </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div class="';
                $value = $this->resolveValue($context->find('footer_col_1_class'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' col-lg-4 col-sm-6 wow animate__animated animate__fadeInUp delay-0-4s">
';
                $buffer .= $indent . '                            <div class="single-footer-widget">
';
                $buffer .= $indent . '
';
                $value = $context->find('footer_col_1_title');
                $buffer .= $this->section28774e105ea13c869f416e184be39b22($context, $indent, $value);
                $buffer .= $indent . '
';
                $value = $context->find('footer_col_1_body');
                $buffer .= $this->section5ecacff1e380add0c0bd650f2484c5df($context, $indent, $value);
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4f6fecb306718d19a6a723eb081cc6a0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="{{{footer_col_2_class}}} wow animate__animated animate__fadeInUp delay-0-4s">
                            <div class="single-footer-widget pl-1">
                                <h3>{{{ footer_col_2_title }}}</h3>
                                {{{ footer_col_2_body }}}
                            </div>
                        </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div class="';
                $value = $this->resolveValue($context->find('footer_col_2_class'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' wow animate__animated animate__fadeInUp delay-0-4s">
';
                $buffer .= $indent . '                            <div class="single-footer-widget pl-1">
';
                $buffer .= $indent . '                                <h3>';
                $value = $this->resolveValue($context->find('footer_col_2_title'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('footer_col_2_body'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC8825d3d051a552095c46ba22496bfaf(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="{{{footer_col_3_class}}} wow animate__animated animate__fadeInUp delay-0-4s">
                            <div class="single-footer-widget pl-1">
                                <h3>{{{ footer_col_3_title }}}</h3>
                                {{{ footer_col_3_body }}}
                            </div>
                        </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div class="';
                $value = $this->resolveValue($context->find('footer_col_3_class'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' wow animate__animated animate__fadeInUp delay-0-4s">
';
                $buffer .= $indent . '                            <div class="single-footer-widget pl-1">
';
                $buffer .= $indent . '                                <h3>';
                $value = $this->resolveValue($context->find('footer_col_3_title'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('footer_col_3_body'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB648c751c81a64e58c64586388c5e740(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="{{{footer_col_4_class}}} wow animate__animated animate__fadeInUp delay-0-4s">
                            <div class="single-footer-widget">
                                <h3>{{{ footer_col_4_title }}}</h3>
                                {{{ footer_col_4_body }}}
                            </div>
                        </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div class="';
                $value = $this->resolveValue($context->find('footer_col_4_class'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' wow animate__animated animate__fadeInUp delay-0-4s">
';
                $buffer .= $indent . '                            <div class="single-footer-widget">
';
                $buffer .= $indent . '                                <h3>';
                $value = $this->resolveValue($context->find('footer_col_4_title'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('footer_col_4_body'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE7c736d59b39dd8ead6eed39bb8ec27c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="{{{footer_col_5_class}}} wow animate__animated animate__fadeInUp delay-0-4s">
                            <div class="single-footer-widget">
                                <h3>{{{ footer_col_5_title }}}</h3>
                                {{{ footer_col_5_body }}}
                            </div>
                        </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div class="';
                $value = $this->resolveValue($context->find('footer_col_5_class'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' wow animate__animated animate__fadeInUp delay-0-4s">
';
                $buffer .= $indent . '                            <div class="single-footer-widget">
';
                $buffer .= $indent . '                                <h3>';
                $value = $this->resolveValue($context->find('footer_col_5_title'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('footer_col_5_body'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD35ebfcab2355297fb4c80a237f35c72(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <img src="{{footer_shape_img1}}" class="shape shape-1" alt="{{sitename}}">
    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <img src="';
                $value = $this->resolveValue($context->find('footer_shape_img1'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="shape shape-1" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section128a09856eee7fa2d27c290bfbe84a4a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <img src="{{footer_shape_img2}}" class="shape shape-2" alt="{{sitename}}">
    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <img src="';
                $value = $this->resolveValue($context->find('footer_shape_img2'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="shape shape-2" alt="';
                $value = $this->resolveValue($context->find('sitename'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7e37250511d419f86a222996c58d565d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-s-fill"></i>
        <i class="ri-arrow-up-s-fill"></i>
    </div>
    <!-- End Go Top Area -->
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <!-- Start Go Top Area -->
';
                $buffer .= $indent . '    <div class="go-top">
';
                $buffer .= $indent . '        <i class="ri-arrow-up-s-fill"></i>
';
                $buffer .= $indent . '        <i class="ri-arrow-up-s-fill"></i>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <!-- End Go Top Area -->
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
