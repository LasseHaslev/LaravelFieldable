<?php

use LasseHaslev\LaravelFieldable\FieldRepresenter;

/**
 * Class FieldRepresenterTest
 * @author Lasse S. Haslev
 */
class FieldValueTest extends TestCase
{
    // Check if we can use a value formater to format value
    // This should have a store and get function
    // etc. image.id to image object and image object to image.id
    // Check if we have an interface for that

    // Can add muliple values if repeatable is true
    // Can NOT add muliple values if repeatable is true
    // if multiple values is added to fieldable if is_repeatable is false. Just update value

    // Write logic to handle the trait to add/handle FieldValue

    // LATER
    // FieldValue obay FieldRepresenter minimum and maximum values
}
