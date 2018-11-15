<?php

namespace Base;

use \Tokens as ChildTokens;
use \TokensQuery as ChildTokensQuery;
use \Exception;
use \PDO;
use Map\TokensTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tokens' table.
 *
 *
 *
 * @method     ChildTokensQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method     ChildTokensQuery orderByEntity($order = Criteria::ASC) Order by the entity column
 * @method     ChildTokensQuery orderByLastUsed($order = Criteria::ASC) Order by the last_used column
 * @method     ChildTokensQuery orderByLifeTime($order = Criteria::ASC) Order by the life_time column
 *
 * @method     ChildTokensQuery groupByToken() Group by the token column
 * @method     ChildTokensQuery groupByEntity() Group by the entity column
 * @method     ChildTokensQuery groupByLastUsed() Group by the last_used column
 * @method     ChildTokensQuery groupByLifeTime() Group by the life_time column
 *
 * @method     ChildTokensQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTokensQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTokensQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTokensQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTokensQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTokensQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTokens findOne(ConnectionInterface $con = null) Return the first ChildTokens matching the query
 * @method     ChildTokens findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTokens matching the query, or a new ChildTokens object populated from the query conditions when no match is found
 *
 * @method     ChildTokens findOneByToken(string $token) Return the first ChildTokens filtered by the token column
 * @method     ChildTokens findOneByEntity(string $entity) Return the first ChildTokens filtered by the entity column
 * @method     ChildTokens findOneByLastUsed(int $last_used) Return the first ChildTokens filtered by the last_used column
 * @method     ChildTokens findOneByLifeTime(int $life_time) Return the first ChildTokens filtered by the life_time column *

 * @method     ChildTokens requirePk($key, ConnectionInterface $con = null) Return the ChildTokens by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTokens requireOne(ConnectionInterface $con = null) Return the first ChildTokens matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTokens requireOneByToken(string $token) Return the first ChildTokens filtered by the token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTokens requireOneByEntity(string $entity) Return the first ChildTokens filtered by the entity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTokens requireOneByLastUsed(int $last_used) Return the first ChildTokens filtered by the last_used column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTokens requireOneByLifeTime(int $life_time) Return the first ChildTokens filtered by the life_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTokens[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTokens objects based on current ModelCriteria
 * @method     ChildTokens[]|ObjectCollection findByToken(string $token) Return ChildTokens objects filtered by the token column
 * @method     ChildTokens[]|ObjectCollection findByEntity(string $entity) Return ChildTokens objects filtered by the entity column
 * @method     ChildTokens[]|ObjectCollection findByLastUsed(int $last_used) Return ChildTokens objects filtered by the last_used column
 * @method     ChildTokens[]|ObjectCollection findByLifeTime(int $life_time) Return ChildTokens objects filtered by the life_time column
 * @method     ChildTokens[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TokensQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TokensQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'maindatabase', $modelName = '\\Tokens', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTokensQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTokensQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTokensQuery) {
            return $criteria;
        }
        $query = new ChildTokensQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTokens|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TokensTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TokensTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTokens A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `token`, `entity`, `last_used`, `life_time` FROM `tokens` WHERE `token` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTokens $obj */
            $obj = new ChildTokens();
            $obj->hydrate($row);
            TokensTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTokens|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TokensTableMap::COL_TOKEN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TokensTableMap::COL_TOKEN, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%', Criteria::LIKE); // WHERE token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokensTableMap::COL_TOKEN, $token, $comparison);
    }

    /**
     * Filter the query on the entity column
     *
     * Example usage:
     * <code>
     * $query->filterByEntity('fooValue');   // WHERE entity = 'fooValue'
     * $query->filterByEntity('%fooValue%', Criteria::LIKE); // WHERE entity LIKE '%fooValue%'
     * </code>
     *
     * @param     string $entity The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByEntity($entity = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entity)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokensTableMap::COL_ENTITY, $entity, $comparison);
    }

    /**
     * Filter the query on the last_used column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUsed(1234); // WHERE last_used = 1234
     * $query->filterByLastUsed(array(12, 34)); // WHERE last_used IN (12, 34)
     * $query->filterByLastUsed(array('min' => 12)); // WHERE last_used > 12
     * </code>
     *
     * @param     mixed $lastUsed The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByLastUsed($lastUsed = null, $comparison = null)
    {
        if (is_array($lastUsed)) {
            $useMinMax = false;
            if (isset($lastUsed['min'])) {
                $this->addUsingAlias(TokensTableMap::COL_LAST_USED, $lastUsed['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUsed['max'])) {
                $this->addUsingAlias(TokensTableMap::COL_LAST_USED, $lastUsed['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokensTableMap::COL_LAST_USED, $lastUsed, $comparison);
    }

    /**
     * Filter the query on the life_time column
     *
     * Example usage:
     * <code>
     * $query->filterByLifeTime(1234); // WHERE life_time = 1234
     * $query->filterByLifeTime(array(12, 34)); // WHERE life_time IN (12, 34)
     * $query->filterByLifeTime(array('min' => 12)); // WHERE life_time > 12
     * </code>
     *
     * @param     mixed $lifeTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function filterByLifeTime($lifeTime = null, $comparison = null)
    {
        if (is_array($lifeTime)) {
            $useMinMax = false;
            if (isset($lifeTime['min'])) {
                $this->addUsingAlias(TokensTableMap::COL_LIFE_TIME, $lifeTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lifeTime['max'])) {
                $this->addUsingAlias(TokensTableMap::COL_LIFE_TIME, $lifeTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TokensTableMap::COL_LIFE_TIME, $lifeTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTokens $tokens Object to remove from the list of results
     *
     * @return $this|ChildTokensQuery The current query, for fluid interface
     */
    public function prune($tokens = null)
    {
        if ($tokens) {
            $this->addUsingAlias(TokensTableMap::COL_TOKEN, $tokens->getToken(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tokens table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TokensTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TokensTableMap::clearInstancePool();
            TokensTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TokensTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TokensTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TokensTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TokensTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TokensQuery
