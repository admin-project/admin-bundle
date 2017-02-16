<?php
/**
 * Class SimplePager
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\AdminBundle\Datagrid;

use AdminProject\AdminBundle\Model\Proxy\QueryProxyInterface;

/**
 * Class SimplePager
 * @package AdminProject\AdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
abstract class AbstractPager implements \Iterator, \Countable, PagerInterface
{
    /**
     * Saves the max per page.
     * @var int
     */
    private $max;

    /**
     * Saves the current page.
     * @var int
     */
    private $page = 1;

    /**
     * Saves the query.
     * @var QueryProxyInterface
     */
    protected $query;

    /**
     * Saves the results
     * @var array
     */
    private $results;

    /**
     * Saves the results count
     * @var int
     */
    private $resultsCounter;

    /**
     * Saves the last page.
     * @var int
     */
    private $lastPage;

    /**
     * Saves the number of results.
     * @var int
     */
    private $numberResults;

    /**
     * SimplePager constructor.
     * @param int $max
     */
    public function __construct($max = 10)
    {
        $this->setMaxPerPage($max);
    }

    /**
     * Sets the max items per page.
     * @param int $max
     * @return void
     */
    public function setMaxPerPage($max)
    {
        $this->max = $max;
    }

    /**
     * Sets the current page.
     * @param int $page
     * @return void
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * Sets the query
     * @param QueryProxyInterface $query
     * @return void
     */
    public function setQuery(QueryProxyInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Sets the last page.
     * @param int $lastPage
     * @return void
     */
    public function setLastPage($lastPage)
    {
        $this->lastPage = $lastPage;

        if ($this->getPage() > $lastPage) {
            $this->setPage($lastPage);
        }
    }

    /**
     * Sets the number of results.
     * @param int $numberResults
     * @return void
     */
    public function setNumberResults($numberResults)
    {
        $this->numberResults = $numberResults;
    }

    /**
     * Returns the last page.
     * @return int
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * Returns the max
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Returns the page
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Returns the query proxy interface
     * @return QueryProxyInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Returns the number of results.
     * @return int
     */
    public function getNumberResults()
    {
        return $this->numberResults;
    }

    /**
     * Checks if the iterator is initialized
     * @return bool
     */
    private function isIteratorInitialized()
    {
        return $this->results != false;
    }

    /**
     * Initialize the iterator.
     * @return void
     */
    private function initializeIterator()
    {
        if (!$this->isIteratorInitialized()) {
            $this->results        = $this->getResults();
            $this->resultsCounter = count($this->results);
        }
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        $this->initializeIterator();

        return current($this->results);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->initializeIterator();

        --$this->resultsCounter;

        next($this->results);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        $this->initializeIterator();

        return key($this->results);
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        $this->initializeIterator();

        return $this->resultsCounter > 0;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->initializeIterator();

        $this->resultsCounter = count($this->results);

        reset($this->results);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return $this->getNumberResults();
    }

}