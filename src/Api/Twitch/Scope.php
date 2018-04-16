<?php
/**
 * Created by PhpStorm.
 * User: Forien
 * Date: 15.04.2018
 * Time: 21:28
 */

namespace Forien\Api\Twitch;

/**
 * Class Scopes
 *
 * @package Forien\Api\Twitch
 */
final class Scope
{
    const ANALYTICS_READ_GAMES = 'analytics:read:games';
    const BITS_READ            = 'bits:read';
    const CLIPS_EDIT           = 'clips:edit';
    const USER_EDIT            = 'user:edit';
    const USER_READ_EMAIL      = 'user:read:email';

    private $scopes           = [];
    private $definedConstants = [];

    /**
     * Scope constructor.
     *
     * @param array $scopes
     *
     * @throws \ReflectionException
     */
    public function __construct(array $scopes)
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        $this->definedConstants = $reflectionClass->getConstants();
        unset($reflectionClass);

        $this->setScopes($scopes);
    }

    /**
     * @return array
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     *
     * @return Scope
     */
    public function setScopes(array $scopes): Scope
    {
        $this->scopes = array_intersect($this->definedConstants, $scopes);

        return $this;
    }

    /**
     * @param array $scopes
     *
     * @return Scope
     */
    public function addScopes(array $scopes): Scope
    {
        $newScopes = array_intersect($this->definedConstants, $scopes);
        $this->scopes = array_unique(array_merge($this->scopes, $newScopes));

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(' ', $this->scopes);
    }
}