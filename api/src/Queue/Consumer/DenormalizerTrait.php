<?php declare(strict_types=1);

namespace App\Queue\Consumer;

use App\Queue\Message\NamedMessageInterface;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

trait DenormalizerTrait
{
    /**
     * @param string $message
     * @return NamedMessageInterface
     */
    protected function denormalizeMessage(string $message)
    {
        $normalizer = new PropertyNormalizer();
        $array = json_decode($message);

        /** @var NamedMessageInterface $event */
        $event = $normalizer->denormalize(
            $array->event,
            $array->class,
            'json'
        );

        return $event;
    }
}
