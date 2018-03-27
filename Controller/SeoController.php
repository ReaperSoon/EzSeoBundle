<?php

namespace Smile\EzSeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function showMetaSeoAction( $content, $prefix = "", $suffix = "" )
    {
        $seoService = $this->get('smile.ez_seo');
        $seo = $seoService->getSEO($content, $prefix, $suffix);

        $response = new Response();
        if ($seo != null)
        {
            $response = $this->render("SmileEzSeoBundle:seo:seo.html.twig", [
                'seo'       => $seo
            ]);
        }
        return $response;
    }
}