<?php

namespace App\Modules\Shared\Model;

use phpseclib3\Math\BigInteger;

class Permission
{
    public function __construct(
        private int $version,
        private BigInteger $flag
    ) {
        // Perform version upgrades if needed
        if ($version <= 1) {
            if ($this->isAllowedBitFlag(10, $flag)) {
                $flag = $this->allowBitFlag(164, $flag);
            }

            $version = 2;
        }

        if ($version <= 2) {
            $version = 3;
        }

        $this->version = $version;
        $this->flag = $flag;
    }

    public function getFlag(?int $version = null): BigInteger
    {
        // No version specified, return current flag
        if ($version === null) {
            return $this->flag;
        }

        $flag = clone $this->flag;

        // Apply backward compatibility transformations
        if ($version <= 2) {
            // Downgrade logic for v2 (none specified in original)
        }

        if ($version <= 1) {
            if ($this->isAllowedBitFlag(164, $flag)) {
                $flag = $this->allowBitFlag(10, $flag);
            }
        }

        return $flag;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    private function isAllowedBit(int $shift): bool
    {
        return !$this->flag->bitwise_and($this->bit($shift))->equals(new BigInteger('0'));
    }

    private function allowBit(int $shift): void
    {
        $this->flag = $this->flag->bitwise_or($this->bit($shift));
    }

    private function denyBit(int $shift): void
    {
        $this->flag = $this->flag->bitwise_xor($this->bit($shift));
    }

    private function isAllowedBitFlag(int $shift, BigInteger $flag): bool
    {
        return !$flag->bitwise_and($this->bit($shift))->equals(new BigInteger('0'));
    }

    private function allowBitFlag(int $shift, BigInteger $flag): BigInteger
    {
        return $flag->bitwise_or($this->bit($shift));
    }

    private function bit(int $shift): BigInteger
    {
        static $bit_one;
        $bit_one ??= new BigInteger('1');
        return $bit_one->bitwise_leftShift($shift);
    }
}
