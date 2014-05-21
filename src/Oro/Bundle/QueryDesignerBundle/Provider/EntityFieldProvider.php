<?php

namespace Oro\Bundle\QueryDesignerBundle\Provider;

use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Translation\Translator;

use Doctrine\ORM\Mapping\ClassMetadata;

use Oro\Bundle\EntityBundle\ORM\EntityClassResolver;
use Oro\Bundle\EntityBundle\Provider\EntityFieldProvider as ParentEntityFieldProvider;
use Oro\Bundle\EntityBundle\Provider\VirtualFieldProvider;

use Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider;

use Oro\Bundle\QueryDesignerBundle\QueryDesigner\Manager as QueryDesignerManager;

class EntityFieldProvider extends ParentEntityFieldProvider
{
    /** @var QueryDesignerManager */
    protected $queryDesignerManager;

    /** @var string */
    protected $queryType;

    public function __construct(
        ConfigProvider $entityConfigProvider,
        ConfigProvider $extendConfigProvider,
        EntityClassResolver $entityClassResolver,
        ManagerRegistry $doctrine,
        Translator $translator,
        VirtualFieldProvider $virtualFieldProvider,
        $hiddenFields,
        QueryDesignerManager $qdManager
    ) {
        parent::__construct(
            $entityConfigProvider,
            $extendConfigProvider,
            $entityClassResolver,
            $doctrine,
            $translator,
            $virtualFieldProvider,
            $hiddenFields
        );

        $this->queryDesignerManager = $qdManager;
    }

    /**
     * @param string $queryType
     */
    public function setQueryType($queryType)
    {
        $this->queryType = $queryType;
    }

    /**
     * {@inheritdoc}
     */
    protected function isIgnoredField(ClassMetadata $metadata, $fieldName)
    {
        $result = parent::isIgnoredField($metadata, $fieldName);

        if (!$result) {
            $result = $this->queryDesignerManager->isIgnoredField($metadata, $fieldName, $this->queryType);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    protected function isIgnoredRelation(ClassMetadata $metadata, $associationName)
    {
        $result = parent::isIgnoredRelation($metadata, $associationName);

        if (!$result) {
            $result = $this->queryDesignerManager->isIgnoredAssosiation($metadata, $associationName, $this->queryType);
        }

        return $result;
    }
}
