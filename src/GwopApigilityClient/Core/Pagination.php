<?php
namespace GwopApigilityClient\Core;

final class Pagination
{
    /**
     * @const String Índice primário da paginação
     */
    const ROOT = '_links';

    /**
     * @const String Índice que contém o link página
     */
    const HREF = 'href';

    /**
     * @const String Índice da página atual
     */
    const CURRENT = 'self';

    /**
     * @const String Índice da primeira página
     */
    const FIRST = 'first';

    /**
     * @const String Índice da próxima página
     */
    const NEXT = 'next';

    /**
     * @const String Índice da última página
     */
    const LAST = 'last';
}
