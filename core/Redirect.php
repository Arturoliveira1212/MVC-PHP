<?php

namespace core;

class Redirect {
    /**
     * Redireciona para a URL especificada.
     *
     * @param string $url A URL para redirecionar.
     * @param int $statusCode O código de status HTTP para o redirecionamento (padrão: 302).
     */
    public static function to( string $url, int $statusCode = 302) {
        header("Location: $url", true, $statusCode);
        exit();
    }

    /**
     * Redireciona de volta para a página anterior.
     */
    public static function back() {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Redireciona para uma página padrão se o referer não estiver disponível
            self::to('/');
        }
    }
}
