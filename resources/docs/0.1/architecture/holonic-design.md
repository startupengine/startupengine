# Design Principles

---

- [About Holons](#about)
- [Deployment Modes](#deployment-modes)

<a id="about"></a>
## About Holons
 
<larecipe-card shadow>
    <larecipe-badge type="warning" circle class="mr-3" icon="fa fa-lightbulb-o"></larecipe-badge> <b>Concept: Holons</b>
    <br><br>
    A holon (Greek: ὅλον, holon neuter form of ὅλος, holos "whole") is something that is simultaneously a whole and a part.
    <br><br>
    The word was coined by Arthur Koestler in his book <i>The Ghost in the Machine</i> (1967, p. 48). 
</larecipe-card>

<a id="deployment-modes"></a>
## Deployment Modes

Startup Engine can be deployed in three different modes. 
- Slave Mode
- Master Mode
- Hybrid Mode

An instance of Startup Engine which as been deployed in **Slave Mode** can be controlled remotely by another deployment of Startup Engine.

An instance of Startup Engine which as been deployed in **Master Mode** can control another deployment of Startup Engine.

An instance of Startup Engine which as been deployed in **Hybrid Mode** can both control other deployments of Startup Engine and be controlled by other instances of Startup Engine.