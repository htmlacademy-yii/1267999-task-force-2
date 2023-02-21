<?php
declare(strict_types=1);
namespace taskforce\utils;

use SebastianBergmann\Template\RuntimeException;
use SplFileObject;
use taskforce\exception\SourceFileException;
use taskforce\exception\FileFormatException;

class DataConversion
{
    protected $filename = null;
    protected $fileObject = null;
    protected $result = [];

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function import()
    {
        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }
        try {
            $this->fileObject = new SplFileObject($this->filename);
        }
        catch (RuntimeException $exception) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }
        foreach ($this->fileObject as $line_num => $line) {
            $this->result[$line_num] = explode(",", $line);
        }
    }

    public function getNextLine():  ?iterable
    {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }

        return $result;
    }
    public function getData(int $index): array
    {
        $data = array_slice($this->result, $index);
        return $data;
    }
    public function getFilename(): string
    {
        return $this->filename;
    }
}
