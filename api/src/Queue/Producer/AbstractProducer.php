<?php declare(strict_types=1);

namespace App\Queue\Producer;

use App\Queue\Message\NamedMessageInterface;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

abstract class AbstractProducer
{
    /**
     * @param NamedMessageInterface $event
     * @return string
     */
    public function createEnvelope(NamedMessageInterface $event)
    {
        $normalizer = new PropertyNormalizer();

        return json_encode([
            'class' => \get_class($event),
            'event' => $normalizer->normalize($event, 'json')
        ]);
    }
}
