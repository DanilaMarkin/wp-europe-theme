<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* menus-wrap.twig */
class __TwigTemplate_f6508c8f89378cebe52499738fdb2bb3ef9d1691e2cb236e6c1dbdb53d9bcf2c extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"wrap\">
    <h1>";
        // line 2
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "title", []), "html", null, true);
        echo "</h1>

    ";
        // line 4
        if (($context["is_standalone"] ?? null)) {
            // line 5
            echo "        ";
            $this->loadTemplate("nav-menus-standalone.twig", "menus-wrap.twig", 5)->display($context);
            // line 6
            echo "    ";
        } elseif (($context["set_up_wizard_run"] ?? null)) {
            // line 7
            echo "        ";
            $this->loadTemplate("nav-menus-full.twig", "menus-wrap.twig", 7)->display($context);
            // line 8
            echo "    ";
        } else {
            // line 9
            echo "        <nav class=\"wcml-tabs wpml-tabs\"></nav>
    ";
        }
        // line 11
        echo "
    <div class=\"wcml-wrap\">
    ";
        // line 13
        echo ($context["content"] ?? null);
        echo "
    </div>

    ";
        // line 16
        if ($this->getAttribute(($context["rate"] ?? null), "on", [])) {
            // line 17
            echo "        <div class=\"wcml-wrap wcml-notice otgs-is-dismissible\">
            <p>";
            // line 18
            echo $this->getAttribute(($context["rate"] ?? null), "message", []);
            echo "</p>
            <button class=\"notice-dismiss hide-rate-block\" data-setting=\"rate-block\">
                    <span class=\"screen-reader-text\">";
            // line 20
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["rate"] ?? null), "hide_text", []), "html", null, true);
            echo "</span>
            </button>
            ";
            // line 22
            echo $this->getAttribute(($context["rate"] ?? null), "nonce", []);
            echo "
        </div>
    ";
        }
        // line 25
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "menus-wrap.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 25,  83 => 22,  78 => 20,  73 => 18,  70 => 17,  68 => 16,  62 => 13,  58 => 11,  54 => 9,  51 => 8,  48 => 7,  45 => 6,  42 => 5,  40 => 4,  35 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "menus-wrap.twig", "D:\\Program\\OSPanel\\domains\\europe-theme\\wp-content\\plugins\\woocommerce-multilingual\\templates\\menus-wrap.twig");
    }
}
