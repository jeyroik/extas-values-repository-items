<?php
namespace extas\interfaces\values;

use extas\interfaces\IHasValue;
use extas\interfaces\IItem;

/**
 * Interface IRepositoryValue
 *
 * @package extas\interfaces\values
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IRepositoryValue extends IItem
{
    public const SUBJECT = 'extas.value';

    public const FIELD__REPOSITORY_NAME = 'repository';
    public const FIELD__METHOD = 'method';
    public const FIELD__QUERY = 'query';
    public const FIELD__REPLACES = 'replaces';
    public const FIELD__FIELD = 'field';

    /**
     * @return mixed
     */
    public function buildValue();

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return string
     */
    public function getField(): string;

    /**
     * @return string
     */
    public function getRepositoryName(): string;

    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return array
     */
    public function getQuery(): array;

    /**
     * @return array
     */
    public function getReplaces(): array;

    /**
     * @param string $field
     * @return IRepositoryValue
     */
    public function setField(string $field): IRepositoryValue;

    /**
     * @param string $name
     * @return $this
     */
    public function setRepositoryName(string $name): IRepositoryValue;

    /**
     * @param string $name
     * @return $this
     */
    public function setMethod(string $name): IRepositoryValue;

    /**
     * @param array $query
     * @return $this
     */
    public function setQuery(array $query): IRepositoryValue;

    /**
     * @param array $replaces
     * @return $this
     */
    public function setReplaces(array $replaces): IRepositoryValue;
}