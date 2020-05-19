<?php
namespace extas\components\values;

use extas\components\Item;
use extas\components\Replace;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\values\IRepositoryValue;

/**
 * Class RepositoryValue
 *
 * @package extas\components\values
 * @author jeyroik <jeyroik@gmail.com>
 */
class RepositoryValue extends Item implements IRepositoryValue
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function buildValue()
    {
        if (!$this->isValid()) {
            throw new \Exception('Invalid fields values');
        }

        $repo = $this->getRepo();
        $method = $this->getMethod();
        $query = Replace::please()->apply($this->getReplaces())->to($this->getQuery());

        return $repo->$method($query);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->getRepo() && $this->getMethod();
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->config[static::FIELD__REPOSITORY_NAME] ?? '';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->config[static::FIELD__METHOD] ?? '';
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->config[static::FIELD__QUERY] ?? [];
    }

    /**
     * @return array
     */
    public function getReplaces(): array
    {
        return $this->config[static::FIELD__REPLACES] ?? [];
    }

    /**
     * @param string $name
     * @return $this|IRepositoryValue
     */
    public function setRepositoryName(string $name): IRepositoryValue
    {
        $this->config[static::FIELD__REPOSITORY_NAME] = $name;

        return $this;
    }

    /**
     * @param string $name
     * @return $this|IRepositoryValue
     */
    public function setMethod(string $name): IRepositoryValue
    {
        $this->config[static::FIELD__METHOD] = $name;

        return $this;
    }

    /**
     * @param array $query
     * @return $this|IRepositoryValue
     */
    public function setQuery(array $query): IRepositoryValue
    {
        $this->config[static::FIELD__QUERY] = $query;

        return $this;
    }

    /**
     * @param array $replaces
     * @return $this|IRepositoryValue
     */
    public function setReplaces(array $replaces): IRepositoryValue
    {
        $this->config[static::FIELD__REPLACES] = $replaces;

        return $this;
    }

    /**
     * @return IRepository|null
     */
    protected function getRepo(): ?IRepository
    {
        $repoName = $this->getRepositoryName();

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
        return static::SUBJECT;
    }
}
