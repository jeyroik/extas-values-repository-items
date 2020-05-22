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
     * @param array $value
     * @return string
     */
    public function getField(array $value): string;

    /**
     * @param array $value
     * @return string
     */
    public function getRepositoryName(array $value): string;

    /**
     * @param array $value
     * @return string
     */
    public function getMethod(array $value): string;

    /**
     * @param array $value
     * @return array
     */
    public function getQuery(array $value): array;
}
