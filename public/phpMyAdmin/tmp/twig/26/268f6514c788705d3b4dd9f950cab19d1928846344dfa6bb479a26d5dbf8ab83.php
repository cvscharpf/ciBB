<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* display/export/selection.twig */
class __TwigTemplate_028088c4e2c7235dca310d215ecdb4742566b99bcf6a2f3682ade211c7b2a1e6 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"exportoptions\" id=\"databases_and_tables\">
    ";
        // line 2
        if ((($context["export_type"] ?? null) == "server")) {
            // line 3
            echo "        <h3>";
            echo _gettext("Databases:");
            echo "</h3>
    ";
        } elseif ((        // line 4
($context["export_type"] ?? null) == "database")) {
            // line 5
            echo "        <h3>";
            echo _gettext("Tables:");
            echo "</h3>
    ";
        }
        // line 7
        echo "    ";
        if ( !twig_test_empty(($context["multi_values"] ?? null))) {
            // line 8
            echo "        ";
            echo ($context["multi_values"] ?? null);
            echo "
    ";
        }
        // line 10
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/selection.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 10,  58 => 8,  55 => 7,  49 => 5,  47 => 4,  42 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "display/export/selection.twig", "C:\\Users\\Admin\\Desktop\\CS506\\_project\\ciBB\\public\\phpMyAdmin\\templates\\display\\export\\selection.twig");
    }
}
