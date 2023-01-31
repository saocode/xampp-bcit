<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* login/twofactor/application_configure.twig */
class __TwigTemplate_24a6133ced5b24e41e97bb47e2a1c656c7635917a39306c517db09ee6fef9de5 extends \Twig\Template
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
        echo PhpMyAdmin\Url::getHiddenInputs();
        echo "
";
        // line 2
        if ((isset($context["image"]) || array_key_exists("image", $context))) {
            // line 3
            echo "<p>
    ";
            // line 4
            echo _gettext("Please scan following QR code into the two-factor authentication app on your device and enter authentication code it generates.");
            // line 5
            echo "</p>
<p>
    <img src=\"";
            // line 7
            echo twig_escape_filter($this->env, ($context["image"] ?? null), "html", null, true);
            echo "\">
</p>
";
        } else {
            // line 10
            echo "<p>
    ";
            // line 11
            echo _gettext("Please enter following secret/key into the two-factor authentication app on your device and enter authentication code it generates.");
            // line 12
            echo "</p>
<p>
    ";
            // line 14
            echo _gettext("OTP url:");
            echo " <strong>";
            echo twig_escape_filter($this->env, ($context["url"] ?? null), "html", null, true);
            echo "</strong>
</p>
";
        }
        // line 17
        echo "<p>
    ";
        // line 18
        echo _gettext("Secret/key:");
        echo " <strong>";
        echo twig_escape_filter($this->env, ($context["secret"] ?? null), "html", null, true);
        echo "</strong>
</p>
<p>
    <label>";
        // line 21
        echo _gettext("Authentication code:");
        echo " <input type=\"text\" name=\"2fa_code\" autocomplete=\"off\"></label>
</p>
";
    }

    public function getTemplateName()
    {
        return "login/twofactor/application_configure.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 21,  71 => 18,  68 => 17,  60 => 14,  56 => 12,  54 => 11,  51 => 10,  45 => 7,  41 => 5,  39 => 4,  36 => 3,  34 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "login/twofactor/application_configure.twig", "C:\\xampp\\phpMyAdmin\\templates\\login\\twofactor\\application_configure.twig");
    }
}
