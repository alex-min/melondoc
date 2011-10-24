<?php

/* test_twig.html */
class __TwigTemplate_81ddac74a0f9b1e44ae026535947e282 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<div class=\"test\">";
        echo twig_escape_filter($this->env, $this->getContext($context, "variable"), "html", null, true);
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "test_twig.html";
    }

    public function isTraitable()
    {
        return false;
    }
}
