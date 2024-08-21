<?php

use Testing\Feature\Domain\Tests\ObjectMothers\UserEntityMother;

/**
 * @throws Exception
 */
function test_user_is_able_to_edit_video_with_enough_access_level(): void
{
    $user = UserEntityMother::fromPrimitives(accessLevel: 3);

    assertThat(true, $user->canEditVideos());
}

/**
 * @throws Exception
 */
function test_user_is_not_able_to_edit_videos_without_enough_access_level(): void
{
    $user = UserEntityMother::fromPrimitives(accessLevel: 1);

    assertThat(false, $user->canEditVideos());
}

/**
 * @throws Exception
 */
function assertThat(bool $expected, bool $actual): void
{
    if ($expected !== $actual) {
        throw new Exception('Condition not satisfied');
    }
}
