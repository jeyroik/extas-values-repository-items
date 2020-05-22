<?php
namespace extas\interfaces\values;

/**
 * Interface IRepositoryValue
 *
 * @package extas\interfaces\values
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IRepositoryValue extends IValueDispatcher
{
    public const FIELD__REPOSITORY_NAME = 'repository';
    public const FIELD__METHOD = 'method';
    public const FIELD__QUERY = 'query';
    public const FIELD__FIELD = 'field';

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
}
