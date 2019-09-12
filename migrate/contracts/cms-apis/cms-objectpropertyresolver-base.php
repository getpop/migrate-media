<?php
namespace PoP\Media;

abstract class ObjectPropertyResolver_Base implements ObjectPropertyResolver
{
    public function __construct()
    {
        ObjectPropertyResolverFactory::setInstance($this);
    }
}
