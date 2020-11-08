<?php
declare(strict_types=1);

namespace App\Utils;

use Symfony\Component\Translation\Translator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigTranslation extends AbstractExtension
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function getName()
    {
        return 'twig_translation';
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('trans', array($this, 'trans'))
        ];
    }

    public function trans($key, $args = [], $domain = null)
    {
        return $this->translator->trans($key, $args, $domain);
    }
}