{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §This game was made with c# in Unity. Code all made by me. Art from the assetstore.§--}}
{{-- TAGS §4 weeks, 1 dev§ --}}
{{-- IMAGE §images/unity/the-play.png§ --}}
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
        <h1>The Play</h1>
        <p>This game was made in 4 weeks with c# in unity.<br> All code by me. Art from the assetstore.</p>

        <video autoplay muted loop>
            <source src="{{ asset('videos/ThePlay.mp4') }}" type="video/mp4">
        </video>

        <p>The Play is a game where you play as a hero in a stage performance. Your goal is to defeat the evil wizard to make the crowd happy.</p>

        <h1>Some of the features I made</h1>
        <h2>Attack manager:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/ThePlayAttacks.mp4') }}" type="video/mp4">
        </video>

        <p>The attack manager handles switching between enemy attacks and ensures that certain attacks can't be used if they're already active.<br></p>

        <h1>Displaying C# Code</h1>
        <p>In the code below you see how I made the attack manager</p>
        <pre><code>private IEnumerator Attackin()
{
    int attack;

    // Initial delay before the first attack
    if (_Start == true)
    {
        yield return new WaitForSeconds((_AttackCooldown / _attackspeed) / 10);
        _Start = false;
    }
    else
    {
        // Regular delay between attacks
        yield return new WaitForSeconds(_AttackCooldown / _attackspeed);
    }

    // Determine which attack to perform based on current conditions
    if (GameObject.FindGameObjectWithTag("FloorIsLava"))
    {
        if (FindObjectOfType&lt; FireCircle&gt;() != null)
        {
            // Choose an attack randomly, avoiding Fire Circle if Fire Circle is active
            attack = Random.Range(1, _Attacks.Count);
            while (attack == 2)
            {
                attack = Random.Range(1, _Attacks.Count);
            }
            Instantiate(_Attacks[attack], _AttacksParent);
        }
        else
        {
            // Choose any attack randomly
            attack = Random.Range(1, _Attacks.Count);
            Instantiate(_Attacks[attack], _AttacksParent);
        }
    }
    else
    {
        if (FindObjectOfType&lt; FireCircle&gt;() != null)
        {
            // Choose an attack randomly, avoiding Fire Circle if Fire Circle is active
            attack = Random.Range(0, _Attacks.Count);
            while (attack == 2)
            {
                attack = Random.Range(0, _Attacks.Count);
            }
            Instantiate(_Attacks[attack], _AttacksParent);
        }
        else
        {
            // Choose any attack randomly
            attack = Random.Range(0, _Attacks.Count);
            Instantiate(_Attacks[attack], _AttacksParent);
        }
    }

    // Trigger the appropriate animation based on the chosen attack
    if (attack == 0)
    {
        _Animator.SetTrigger("Lava");
    }
    else if (attack == 1)
    {
        _Animator.SetTrigger("Meteor");
    }
    else
    {
        _Animator.SetTrigger("FireCircle");
    }

    // Recursively start the attack sequence again
    StartCoroutine(Attackin());
</code></pre>

        <p>While working on this code, I had trouble preventing certain attacks from being activated when they were already active. I decided on the current approach, where instead of canceling the attack, a different one is triggered, making the combat more dynamic.</p>

        <h2>Meteor attack:</h2>

        <video autoplay muted loop>
            <source src="{{ asset('videos/ThePlayMeteor.mp4') }}" type="video/mp4">
        </video>

        <p>The meteor attack is the enemy's primary attack.</p>

        <h3>MeteorAttack</h3>
        <pre><code>private IEnumerator MeteorAttack(RaycastHit hit)
{
    // Instantiate the impact zone at the point where the meteor hits
    GameObject thisInpacktsone = Instantiate(
        _InpacktZone,
        hit.point,
        transform.rotation,
        GameObject.FindGameObjectWithTag("AttackParent").transform
    );

    // Move the meteor to the impact point
    while (transform.position != new Vector3(hit.point.x, hit.point.y + 0.5f, hit.point.z))
    {
        yield return new WaitForEndOfFrame();
        transform.position = Vector3.MoveTowards(
            transform.position,
            new Vector3(hit.point.x, hit.point.y + 0.5f, hit.point.z),
            Time.deltaTime * _Speed
        );
    }

    // Check for players within the impact zone
    Collider[] PlayerInInpacktZone = Physics.OverlapSphere(
        thisInpacktsone.transform.position,
        thisInpacktsone.transform.lossyScale.x / 2,
        _TargetMask
    );

    // If players are in the impact zone, apply damage
    if (PlayerInInpacktZone.Length != 0)
    {
        foreach (Collider coll in PlayerInInpacktZone)
        {
            if (coll.CompareTag("Player"))
            {
                // Apply damage to the player
                _player.GetComponent&lt;HP&gt;().TakeDmg(_Dmg);
            }
        }
    }

    // Destroy the impact zone object after dealing damage
    Destroy(thisInpacktsone);

    // Wait for 1 second before moving the meteor back to its starting position
    yield return new WaitForSeconds(1);

    // Move the meteor back to its starting position
    while (transform.position != _startPos)
    {
        yield return new WaitForEndOfFrame();
        transform.position = Vector3.MoveTowards(
            transform.position,
            _startPos,
            Time.deltaTime * _Speed
        );
    }

    // Destroy the meteor game object after it returns to the starting position
    Destroy(gameObject);
}
</code></pre>
    </div>
@endsection
