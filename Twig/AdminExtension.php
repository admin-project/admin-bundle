<?php
/**
 * Class AdminExtension
 * @package AdminProject\AdminBundle\Twig
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Twig;

use AdminProject\AdminBundle\FieldMapper\AbstractFieldMapperDescriptor;

/**
 * Class AdminExtension
 * @package AdminProject\AdminBundle\Twig
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class AdminExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'render_list_field',
                [
                    $this,
                    'renderListField'
                ],
                [
                    'is_safe'           => ['html'],
                    'needs_environment' => true,
                ]
            )
        ];
    }

    public function renderListField(\Twig_Environment $environment, $object, AbstractFieldMapperDescriptor $descriptor)
    {
        $templateName = $descriptor->getTemplate();

        try {
            $template = $environment->loadTemplate($templateName);

            $output = $template->render([
                'admin'      => $descriptor->getAdmin(),
                'object'     => $object,
                'value'      => $descriptor->getValue($object),
                'descriptor' => $descriptor
            ]);

            return sprintf(
                '<!-- FIELD %s:%s START -->%s<!-- FIELD %s:%s END -->',
                $descriptor->getName(),
                $descriptor->getType(),
                $output,
                $descriptor->getName(),
                $descriptor->getType()
            );

            return $output;
        } catch (\Twig_Error_Loader $errorLoaderException) {
            return $descriptor->getValue($object);
        }
    }
}