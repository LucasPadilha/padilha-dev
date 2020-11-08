<?php
declare(strict_types=1);

namespace App\Utils;

use Slim\Flash\Messages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigFlash extends AbstractExtension
{
    private $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    public function getName()
    {
        return 'twig_flash';
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('flash', array($this, 'flash'))
        ];
    }

    public function flash($key = null, $first = false)
    {
        if ($key !== null) {
            if ($first) {
                return $this->messages->getFirstMessage($key);
            }

            return $this->messages->getMessage($key);
        }

        return $this->messages->getMessages();
    }
}