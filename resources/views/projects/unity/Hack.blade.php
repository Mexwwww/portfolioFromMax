{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §This game was made with c# in Unity.§--}}
{{-- TAGS §4 weeks, 2 developers, 3 artists§ --}}
{{-- IMAGE §images/unity/hack.png§ --}}
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

    .project-detail h2 {
        margin-top: 2rem;
    }
</style>
@extends('Layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Hack</h1>
        <p>This game was made in 4 weeks with c# in unity. <br>with 2 developers and 3 artists</p>

        <video autoplay muted loop>
            <source src="{{ asset('videos/Hack.mp4') }}" type="video/mp4">
        </video>

        <p>Hack is a game where you're hacked into a robot of a company and your trying to escape by going into the elevator.</p>

        <h1>My Contributions</h1>
        <h2>Vision cone:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/HackVisioncone.mp4') }}" type="video/mp4">
        </video>

        <p>The vision cone makes it so the enemy can spot you, when they do they will start attacking you.<br></p>

        <h1>Displaying C# Code</h1>
        <p>In the code below you see how I made the vision cone;</p>
        <pre><code>private void FieldOfViewCheck()
{
	//sees if the player is in the radius around the robot.
	Collider[] rangeCecks = Physics. OverlapSphere(transform.position, _Radius, _TargetMask);

	//if the player is in the radius.
	if (rangeCecks.Length != 0)
	{
		Transform taget = rangeCecks[0].transform;
		Vector3 directionToTarget = (taget. position - transform.position).normalized;
		//this makes it so the vision will only be in a surtain angle infront of the robot and not all around you.
		if (Vector3.Angle(transform.forward, directionToTarget) &lt; _Angle / 2)
		{
			DistanceToTarget = Vector3.Distance (transform.position, taget.position);
			//this cecks if there are any obstructions in the line between the robot and the player and if the _Inviseble mode is false.
			if (!Physics.Raycast(transform.position, directionToTarget, DistanceToTarget, _ObstructionMask) &amp;&amp; _Inviseble == false)
			{
				_canSeePlayer = true
			else
			{
				_canSeePlayer = false;
			}
		}
		else
		{
			_canSeePlayer = false;
		}
	}
	else if (_canSeePlayer == true)
	{
		_canSeePlayer = false;
	}
	}
</code></pre>

        <h2>Enemy movement:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/HackEnmeyMovement.mp4') }}" type="video/mp4">
        </video>

        <p>The enemy movement system allows enemies to patrol the area and follow the player once they spot them.</p>

        <h2>Power ups:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/HackPowerUps.mp4') }}" type="video/mp4">
        </video>

        <p>There are two power-ups: the first one makes the player invisible to enemies, while the second one prevents enemies from moving.</p>

        <h2>Elevator animation:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/HackElivatorAnim.mp4') }}" type="video/mp4">
        </video>

        <p>This is the elevator animation for when you enter the elevator. I also created an animation for entering the elevator, which is the same animation but reversed and in a different location.</p>

        <h2>Enemy states:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/HackEnemyStates.mp4') }}" type="video/mp4">
        </video>

        <p>Here are the enemy states: Patrol, Look Around, and Attack.</p>
    </div>
@endsection
