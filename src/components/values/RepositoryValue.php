<?php
namespace extas\components\values;

use extas\components\Replace;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\values\IRepositoryValue;

/**
 * Class RepositoryValue
 *
 * @package extas\components\values
 * @author jeyroik <jeyroik@gmail.com>
 */
class RepositoryValue extends ValueDispatcher implements IRepositoryValue
{
    /**
     * @param mixed $value
     * @return array|mixed
     * @throws \Exception
     */
    public function build($value)
    {
        if (!$this->isValid($value)) {
            throw new \Exception('Invalid fields values');
        }

        $repo = $this->getRepo($value);
        $method = $this->getMethod($value);
        $query = Replace::please()->apply($this->getReplaces())->to($this->getQuery($value));

        $values = $repo->$method($query);

        if ($field = $this->getField($value)) {
            return array_column($values, $field);
        }

        return $values;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return is_array($value) && $this->getRepo($value) && $this->getMethod($value);
    }

    /**
     * @param array $value
     * @return string
     */
    public function getField(array $value): string
    {
        return $value[static::FIELD__FIELD] ?? '';
    }

    /**
     * @param array $value
     * @return string
     */
    public function getRepositoryName(array $value): string
    {
        return $value[static::FIELD__REPOSITORY_NAME] ?? '';
    }

    /**
     * @param array $value
     * @return string
     */
    public function getMethod(array $value): string
    {
        return $value[static::FIELD__METHOD] ?? '';
    }

    /**
     * @param array $value
     * @return array
     */
    public function getQuery(array $value): array
    {
        return $value[static::FIELD__QUERY] ?? [];
    }

    /**
     * @param array $value
     * @return IRepository|null
     */
    protected function getRepo(array $value): ?IRepository
    {
        $repoName = $this->getRepositoryName($value);

        try {
            $repo = $this->$repoName();
        } catch (\Exception $e) {
            return null;
        }

        return $repo;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.value.repository.items';
    }
}
