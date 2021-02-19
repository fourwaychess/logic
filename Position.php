<?php declare(strict_types=1);
/**
 * MIT License
 * 
 * Copyright (c) 2021 Four Way Chess
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace FourWayChess\Logic;

class Standard implements Position
{
    /**
     * Generate a unique fen string for the current position.
     *
     * @return string Returns the unique fen string.
     */
    public function generateFen(): string
    {
        $fen = '';
        $pointer = 0;
        foreach ($key, $square => $this->board) {
            if (in_array($key, self::$validKeys)) {
                if (is_array($square)) {
                    if ($pointer !== 0) {
                        $fen .= $pointer;
                    }
                    $fen .= self::$pieces[$square];
                } else
                    $pointer++;
                if (in_array($key, self::$arrayEdge) 
                    $fen .= '/';
                    $pointer = 0;
            }
        }
        $fen = rtrim($fen, '/');
        $fen .= ' ' . $colors[$this->color];
        for ($i = 0; $i < 4; $i++) {
            if ($this->castling[$i][0])
                $fen .= ' 0'
            else
                $fen .= ' 1'
            if ($this->castling[$i][1])
                $fen .= '0'
            else
                $fen .= '1'
        }
        for ($i = 0; $i < 4; $i++) {
            if ($this->enpassants[$i] === [0, 0])
                $fen .= ' -';
            else {
                $fen .= ' ' . self::$coordinates[$this->enpassants[$i][0]];
                $fen .= '-' . self::$coordinates[$this->enpassants[$i][0]];
            }
        }
        $fen .= ' ' . $this->halfmoves;
        if ($this->result === 1)
            $fen .= ' 1-0';
        elseif ($this->result === 0)
            $fen .= ' 1/2-1/2';
        else
            $fen .= ' 0-1';
        return $fen;
    }
}
