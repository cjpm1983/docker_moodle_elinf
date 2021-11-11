<?php

class __Mustache_0b5ab9111bb8741407bd60aa6484c1b1 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '
';
        $buffer .= $indent . '<style type="text/css">
';
        $buffer .= $indent . '    .modal-dialog {
';
        $buffer .= $indent . '        max-width: 80%;
';
        $buffer .= $indent . '        margin-top: 5px;
';
        $buffer .= $indent . '        margin-bottom: 0;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    .modal-content {
';
        $buffer .= $indent . '        max-height: 99vh;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    #adminer-frame {
';
        $buffer .= $indent . '        background:url(';
        $value = $this->resolveValue($context->find('framebackgroundurl'), $context);
        $buffer .= $value;
        $buffer .= ') center center no-repeat;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        // 'legacycss' section
        $value = $context->find('legacycss');
        $buffer .= $this->section567471a2fea24a1c3fa74ce4f41d980e($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '</style>
';
        // 'legacycss' section
        $value = $context->find('legacycss');
        $buffer .= $this->sectionDc7d5a5b9dc4560fa9f21e6552e8aa79($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- Button to Open the Modal -->
';
        $buffer .= $indent . '<button id="adminerlauncher" type="button" class="btn btn-primary" data-toggle="modal" data-target="#local-adminer-modal">
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->find('adminerlaunchtitle'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '
';
        $buffer .= $indent . '</button>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- The Modal -->
';
        $buffer .= $indent . '<div class="modal fade" id="local-adminer-modal">
';
        $buffer .= $indent . '    <div class="modal-dialog">
';
        $buffer .= $indent . '        <div class="modal-content">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal Header -->
';
        $buffer .= $indent . '            <div class="modal-header">
';
        $buffer .= $indent . '                <h4 class="modal-title">';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</h4>
';
        $buffer .= $indent . '                <button type="button" class="close" data-dismiss="modal">&times;</button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal body -->
';
        $buffer .= $indent . '            <div class="modal-body embed-responsive embed-responsive-16by9">
';
        $buffer .= $indent . '                <iframe id="adminer-frame"
';
        $buffer .= $indent . '                    class="embed-responsive-item"
';
        $buffer .= $indent . '                    src=""
';
        $buffer .= $indent . '                    allowfullscreen >
';
        $buffer .= $indent . '                </iframe>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Modal footer -->
';
        $buffer .= $indent . '            <div class="modal-footer">
';
        $buffer .= $indent . '                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionD9bd62168d56cc60af83d680bf524b6e($context, $indent, $value);

        return $buffer;
    }

    private function section567471a2fea24a1c3fa74ce4f41d980e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        .modal-backdrop.show {
            opacity: 0.8;
        }
        #local-adminer-modal.modal.fade.show {
            opacity: 1;
        }
    ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        .modal-backdrop.show {
';
                $buffer .= $indent . '            opacity: 0.8;
';
                $buffer .= $indent . '        }
';
                $buffer .= $indent . '        #local-adminer-modal.modal.fade.show {
';
                $buffer .= $indent . '            opacity: 1;
';
                $buffer .= $indent . '        }
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDc7d5a5b9dc4560fa9f21e6552e8aa79(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <link rel="stylesheet" href="{{{legacycss}}}">
';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    <link rel="stylesheet" href="';
                $value = $this->resolveValue($context->find('legacycss'), $context);
                $buffer .= $value;
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD9bd62168d56cc60af83d680bf524b6e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    require([\'theme_boost/bootstrap/modal\'], function(modal) {
        $(\'#local-adminer-modal\').modal(\'show\');
    });
    $(\'#local-adminer-modal\').on(\'shown.bs.modal\', function(element) {
        $(\'#adminer-frame\').attr(\'src\', \'{{{adminerurl}}}\');
    });
';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '    require([\'theme_boost/bootstrap/modal\'], function(modal) {
';
                $buffer .= $indent . '        $(\'#local-adminer-modal\').modal(\'show\');
';
                $buffer .= $indent . '    });
';
                $buffer .= $indent . '    $(\'#local-adminer-modal\').on(\'shown.bs.modal\', function(element) {
';
                $buffer .= $indent . '        $(\'#adminer-frame\').attr(\'src\', \'';
                $value = $this->resolveValue($context->find('adminerurl'), $context);
                $buffer .= $value;
                $buffer .= '\');
';
                $buffer .= $indent . '    });
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
