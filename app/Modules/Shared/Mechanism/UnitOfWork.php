<?php


namespace App\Modules\Shared\Mechanism;


use Illuminate\Database\ConnectionInterface;
use Throwable;

class UnitOfWork
{
    private ConnectionInterface $db;
    private EventManager $events;

    public function __construct(ConnectionInterface $db, EventManager $events)
    {
        $this->db = $db;
        $this->events = $events;
    }

    public static function newInstance(ConnectionInterface $db, ?EventManager $events = null): self
    {
        return new self($db, $events ?? resolve(EventManager::class));
    }

    public function begin(): void
    {
        $this->events->hold();
        $this->db->beginTransaction();
    }

    public function commit(): void
    {
        $this->db->commit();
        $this->events->release();
    }

    public function rollback(): void
    {
        $this->db->rollBack();
        $this->events->reset();
    }

    /**
     * @param callable $fn 
     * @return mixed 
     */
    public function transaction(callable $fn)
    {
        $this->begin();
        try {
            $result = $fn();
        } catch (Throwable $e) {
            $this->rollback();
            throw $e;
        }
        $this->commit();
        return $result;
    }
}
