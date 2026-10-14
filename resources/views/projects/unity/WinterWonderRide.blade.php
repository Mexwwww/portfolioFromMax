{{-- Here you can set the description that will show under the title on the select project page --}}
{{-- DESCRIPTION §This game was made with c# in Unity.§ --}}
{{-- TAGS §4 weeks, 2 developers, 4 artists§ --}}
{{-- IMAGE §images/unity/winter-wonder-ride.png§ --}}
<style>
    .project-detail {
        max-width: 850px;
        margin: 6vh auto;
        padding: 2.5rem;
        background: #ffffff;
        border: 1px solid #e1e4e8;
        border-radius: 12px;
        color: #24292e;
        box-shadow: 0 4px 12px rgba(27, 31, 35, 0.05);
    }

    .project-detail video, .project-detail img {
        width: 100%;
        max-width: 639px;
        border-radius: 8px;
        display: block;
        margin: 1rem 0;
        aspect-ratio: 16 / 9;
        background: #f6f8fa;
    }

    .project-detail pre {
        background: #f6f8fa;
        border: 1px solid #e1e4e8;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        color: #0366d6;
        font-family: 'Fira Code', monospace;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    .project-detail h1 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 0.75rem;
    }

    .project-detail h2 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        font-size: 1.4rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-detail p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.1rem;
        color: #586069;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Winter Wonder Ride</h1>
        <p>This game was made in 4 weeks with c# in unity.<br> with 2 developers and 4 artists</p>

        <video autoplay muted loop>
            <source src="{{ asset('videos/WinterWonderLandintro.mp4') }}" type="video/mp4">
        </video>

        <p>Winter Wonder Ride is a single-player racing game developed in Unity using C# over four weeks by a team of two developers and four artists. Players can use power-ups to gain an advantage by making the race easier or increasing their speed.</p>

        <h1>My Contributions</h1>
        <h2>Vehicle Movement:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/WinterWonderRideCarMovement.mp4') }}" type="video/mp4">
        </video>

        <p>To implement vehicle movement, I used wheel colliders and wrote a custom script for driving and steering. I clamped the maximum rotation to prevent the vehicle from tipping over and added code for a functional speedometer. Additionally, I ensured that when the vehicle is airborne, its Z-axis rotation automatically resets to 0, allowing it to always land on its wheels</p>

        <h2>Camera movement while following the car:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/WinterWonderRideCamera.mp4') }}" type="video/mp4">
        </video>

        <p>I created a custom script for the camera movement, making it smoothly follow the car. The script also adjusts the camera's position by moving it closer to the car when there's a wall in the way, preventing the camera from clipping through walls.</p>

        <h1>Displaying C# Code</h1>
        <p><em>In this code snippet you can see how i made the smooth camera movement.</em></p>
        <pre><code>float distanceToCar = Vector3.Distance(transform.position, _car.transform.position);
if (_MaxDistanceToCar - DistanceToCar &lt; 1)
{
	//moves the camera to the location it should be at, at a consistend speed
	transform.position = Vector3.lerp(transform.position, _camFollowPoint.transform.position, _smoothSpeed);
}
else
{
	//moves the camera to the location it should be at, at a speed that goes faster the further the car is away from the camera
	transform.position = Vector3.lerp(transform.position, _camFollowPoint.transform.position, _smoothSpeed * (_MaxDistanceToCar - (_MaxDistanceToCar - distanceToCar)));
}
transform.LookAt(_car.position);

float xVelocity = Mathf.abs(_carRb.velocity.x);
float yVelocity = Mathf.abs(_carRb.velocity.y);
float zVelocity = Mathf.abs(_carRb.velocity.z);

//makes it so the FOV is higer the faster the car goes
_cam.fieldOfView = _StartingFieldOfView + (xVelocity + yVelocity + zVelocity) / 3;
if (_cam.fieldOfView &lt; StaringFieldOfView)
{
	_cam.fieldOfView = _StartingVieldOfView;
}
</code></pre>
        <p><em>This code makes it so the camera follows the car and the faster the car goes the further away the camera and the higer the FOV will be.</em></p>

        <h2>Power ups:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/WinterWonderRidePowerUps.mp4') }}" type="video/mp4">
        </video>

        <p>
            To make the powerups I made a script with 2 functions: 1 for the speed boost and 1 for the shield power.<br>
            The speed boost works by adding vellocity in the derection the Vehicle is going when the cooldown is over and the player hits E.<br>
            The shield works by starting a coroutine that activates the shield GameObject and gradually increases the material's transparency.<br>
            After a set duration, the transparency slowly decreases, and once it reaches 0, the shield GameObject is deactivated. <br>
            The player can track the cooldown time after using a power-up by checking the bottom right of the screen.
        </p>

        <h1>Project in git</h1>
        <a href="https://github.com/MaxGeurts/NightRacer">Git project</a>
    </div>
@endsection
