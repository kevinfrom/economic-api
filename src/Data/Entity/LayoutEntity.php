<?php

namespace Kevinfrom\EconomicApi\Data\Entity;

final class LayoutEntity
{
    /**
     * @param int         $layoutNumber A unique identifier of the layout.
     * @param string|null $name The name of the layout.
     * @param bool|null   $deleted A flag indicating that the layout is deleted. Layouts with this flag set will not appear in the collection of layouts, but resources such as booked invoices might still reference this layout.
     * @param string|null $self A unique link reference to the layout item.
     */
    public function __construct(
        public int $layoutNumber,
        public ?string $name = null,
        public ?bool $deleted = null,
        public ?string $self = null
    ) {
    }
}
