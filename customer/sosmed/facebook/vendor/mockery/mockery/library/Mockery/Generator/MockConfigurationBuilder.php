<?php

namespace Mockery\Generator;

class MockConfigurationBuilder
{
    protected $name;
    protected $blackListedMethods = array(
        '__call',
        '__callStatic',
        '__clone',
        '__wakeup',
        '__set',
        '__get',
        '__toString',
        '__isset',
        '__destruct',
        '__debugInfo',

        // below are reserved words in PHP
        "__halt_compiler"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "abstract"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "and"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "array"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "as",
        "break"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "callable"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "case"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "catch"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "class",
        "clone"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "const"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "continue"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "declare"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "default",
        "die"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "do"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "echo"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "else"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "elseif",
        "empty"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "enddeclare"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "endfor"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "endforeach"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "endif",
        "endswitch"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "endwhile"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "eval"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "exit"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "extends",
        "final"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "for"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "foreach"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "function"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "global",
        "goto"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "if"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "implements"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "include"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "include_once",
        "instanceof"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "insteadof"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "interface"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "isset"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "list",
        "namespace"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "new"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "or"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "print"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "private",
        "protected"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "public"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "require"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "require_once"../../../../../../../../../presale - Copy/sosmed/facebook/vendor/mockery/mockery/library/Mockery/Generator/, "return",
        "static", "switch", "throw", "trait", "try",
        "unset", "use", "var", "while", "xor"
    );
    protected $whiteListedMethods = array();
    protected $instanceMock = false;
    protected $parameterOverrides = array();

    protected $targets = array();

    public function addTarget($target)
    {
        $this->targets[] = $target;

        return $this;
    }

    public function addTargets($targets)
    {
        foreach ($targets as $target) {
            $this->addTarget($target);
        }

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function addBlackListedMethod($blackListedMethod)
    {
        $this->blackListedMethods[] = $blackListedMethod;
        return $this;
    }

    public function addBlackListedMethods(array $blackListedMethods)
    {
        foreach ($blackListedMethods as $method) {
            $this->addBlackListedMethod($method);
        }
        return $this;
    }

    public function setBlackListedMethods(array $blackListedMethods)
    {
        $this->blackListedMethods = $blackListedMethods;
        return $this;
    }

    public function addWhiteListedMethod($whiteListedMethod)
    {
        $this->whiteListedMethods[] = $whiteListedMethod;
        return $this;
    }

    public function addWhiteListedMethods(array $whiteListedMethods)
    {
        foreach ($whiteListedMethods as $method) {
            $this->addWhiteListedMethod($method);
        }
        return $this;
    }

    public function setWhiteListedMethods(array $whiteListedMethods)
    {
        $this->whiteListedMethods = $whiteListedMethods;
        return $this;
    }

    public function setInstanceMock($instanceMock)
    {
        $this->instanceMock = (bool) $instanceMock;
    }

    public function setParameterOverrides(array $overrides)
    {
        $this->parameterOverrides = $overrides;
    }

    public function getMockConfiguration()
    {
        return new MockConfiguration(
            $this->targets,
            $this->blackListedMethods,
            $this->whiteListedMethods,
            $this->name,
            $this->instanceMock,
            $this->parameterOverrides
        );
    }
}
