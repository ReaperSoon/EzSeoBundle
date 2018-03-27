<?php

namespace SteveCohen\EzSeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SeoController extends Controller
{
    public function showMetaSeoAction( $content, $prefix = "", $suffix = "" )
    {
        $seoService = $this->get('stevecohen.ez_seo');
        $seo = $seoService->getSEO($content, $prefix, $suffix);

        $response = new Response();
        if ($seo != null)
        {
            $response = $this->render("SteveCohenEzSeoBundle:seo:seo.html.twig", [
                'seo'       => $seo
            ]);
        }
        return $response;
    }
}