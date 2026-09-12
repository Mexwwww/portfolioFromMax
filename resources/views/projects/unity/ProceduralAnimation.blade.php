{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §I made this with c# in Unity.§--}}
{{-- TAGS §1 dev§ --}}
{{-- IMAGE §images/unity/procedural-animation.png§ --}}
<style>
    .project-detail {
        max-width: 800px;
        margin: 5vh auto;
        padding: 0 1rem;
        color: white;
    }

    .project-detail video, .project-detail img {
        width: 100%;
        max-width: 639px;
        border-radius: 8px;
        display: block;
        margin: 1rem 0;
    }

    .project-detail pre {
        background: #111;
        border: 1px solid darkslategray;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        color: #d4d4d4;
        font-size: 0.85rem;
        line-height: 1.4;
    }
</style>
@extends('Layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Procedural animation</h1>

        <video autoplay muted loop>
            <source src="{{ asset('videos/PAnimation.mp4') }}" type="video/mp4">
        </video>

        <p>Here you see the procedural animation I made in my free time because I was intrested on how it works.</p>

        <h1>Displaying C# Code</h1>
        <p>This is a code snippet from the script I made too make a humaniod walk with procedural animation.</p>

        <pre><code>private void LegPlacement()
{
    // Check if the other leg is currently walking.
    if (_otherFootToGround._ThisLegWalking == true)
    {
        _otherLegWalking = true;
    }
    else
    {
        _otherLegWalking = false;
    }

    // If the other leg is walking, don't move this leg.
    if (_otherLegWalking == true) return;

    // Reset the foot's position to the current calculated position.
    transform.position = _currentPos;

    // Raycast from the leg start downwards to find the ground.
    if (Physics.Raycast(new Vector3(_LegStart.position.x, _LegStart.position.y + 100, _LegStart.position.z), Vector3.down, out RaycastHit hit, 1000, _LayerMask))
    {
        // If the new target position is far enough, initiate a new step.
        if (Vector3.Distance(_newPos, hit.point) &gt; _StepDistance)
        {
	    _lerp = 0;      // Reset the interpolation factor.
	    _newPos = hit.point;  // Update the target position.
        }
    }

    // If a step is in progress, move the foot towards the new position.
    if (_lerp &lt; 1)
    {
        // Raycast again to adjust the foot's target position.
        Physics.Raycast(new Vector3(_LegStart.position.x, _LegStart.position.y + 100, _LegStart.position.z), Vector3.down, out hit, 1000, _LayerMask);

        _newPos = hit.point;
        _ThisLegWalking = true;

        // Lerp the foot's position towards the new position with an arc (using sine for height).
        Vector3 footPosition = Vector3.Lerp(_oldPos, _newPos, _lerp);
        footPosition.y += Mathf.Sin(_lerp * Mathf.PI) * _stephHeight;

         _currentPos = footPosition;

        // Increment the interpolation factor based on speed.
        _lerp += Time.deltaTime * _Speed;
    }
    else
    {
        // If the step is complete, mark this leg as not walking and update the old position.
        _ThisLegWalking = false;
        _oldPos = _newPos;
    }
}
</code></pre>
    </div>
@endsection
