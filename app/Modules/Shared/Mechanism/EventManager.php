<?php

namespace App\Modules\Shared\Mechanism;

class EventManager
{
    /**
     * @var mixed[]
     */
    private array $events = [];
    private bool $on_hold = false;

    public function hold(): void
    {
        $this->on_hold = true;
    }

    /**
     * @param mixed $event 
     */
    public function publish($event): void
    {
        $this->events[] = $event;

        if (!$this->on_hold) $this->release();
    }

    public function release(): void
    {
        $this->on_hold = false;

        /**
         * Consume queued events on this call, if other release()
         * called for the second time, it'll not consume what we're consuming right now.
         * 
         * WHY: This can cause events to effectively executed in reverse order (Unpredicted Behaviour).
         */
        $events_to_be_consumed = $this->events;
        $this->events = [];

        while (!empty($events_to_be_consumed)) {
            $event = array_shift($events_to_be_consumed);
            event($event);
        }
    }

    public function reset(): void
    {
        $this->events = [];
        $this->on_hold = false;
    }
}
