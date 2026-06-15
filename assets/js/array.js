const products = [
    {
        id: 1,
        name: "NBA 2K26",
        price: 815000,
        image: "./assets/img/nba.jpg",
        category: "Playstation",
        description: "Command every court with authenticity and realism Powered by ProPLAY™, giving you ultimate control over how you play in NBA 2K25. Define your legacy in MyCAREER, MyTEAM, MyNBA, and The W."
    },
    {
        id: 2,
        name: "SpongeBob: Titans of the Tide",
        price: 479000,
        image: "./assets/img/spongebob.jpg",
        category: "Switch2",
        description: "Seamlessly switch between SpongeBob and Patrick and combine their unique skills to save Bikini Bottom from total ghostification, a chaos unleashed by a clash between the Flying Dutchman and King Neptune."
    },
    {
        id: 3,
        name: "Kirby: Air Riders",
        price: 950000,
        image: "./assets/img/kirby.jpg",
        category: "Switch2",
        description: "Ready, set, battle! Charge, boost, and spin to attack your rivals in Kirby Air Riders, a fast-paced vehicle action featuring Kirby and crew - only on Nintendo Switch 2."
    },
    {
        id: 4,
        name: "Call of Duty: Black Ops 7",
        price: 999000,
        image: "./assets/img/codbo7.jpg",
        category: "Playstation",
        description: "In Call of Duty®: Black Ops 7, Treyarch and Raven Software are bringing players the biggest Black Ops ever across an innovative Co-Op Campaign, an electrifying Multiplayer experience, and the legendary Round-Based Zombies mode."
    },
    {
        id: 5,
        name: "Ninja Gaiden 4",
        price: 1045000,
        image: "./assets/img/ninja.jpg",
        category: "Playstation",
        description: "The definitive ninja action-adventure franchise returns with NINJA GAIDEN 4! Embark on a cutting-edge adventure where legacy meets innovation in a high-octane blend of style and no-holds-barred combat."
    },
    {
        id: 6,
        name: "Ghost Of Yotei",
        price: 1029000,
        image: "./assets/img/yotei.jpg",
        category: "Playstation",
        description: "Taking place 300 years after the critically acclaimed Ghost of Tsushima, this standalone experience follows a haunted, lone mercenary named Atsu in the 1600s. Thirsty for revenge, she sets out to hunt down those who killed her family many years prior."
    },
    {
        id: 7,
        name: "The Last of Us Part I",
        price: 700000,
        image: "./assets/img/tlou1.png",
        category: "Playstation",
        description: "Discover the award-winning game that inspired the critically acclaimed television show. Guide Joel and Ellie through a post-apocalyptic America, and encounter unforgettable allies and enemies in The Last of Us™."
    },
    {
        id: 8,
        name: "God of War Ragnarök",
        price: 703200,
        image: "./assets/img/gow.png",
        category: "Playstation",
        description: "Kratos and Atreus embark on a mythic journey for answers before Ragnarök arrives - now on Playstation."
    },
    {
        id: 9,
        name: "Red Dead Redemption 2",
        price: 3000,
        image: "./assets/img/rdr2.png",
        category: "Playstation",
        description: "Arthur Morgan and the Van der Linde Gang are outlaws on the run. Followed by federal agents and bounty hunters, they must rob, steal, and fight their way through the wilderness to survive."
    },
    {
        id: 10,
        name: "The Last of Us Part II",
        price: 850000,
        image: "./assets/img/tlou2.png",
        category: "Playstation",
        description: "Experience the winner of over 300 Game of the Year awards, now on Playstation. Discover Ellie and Abby's story with graphical enhancements, gameplay modes like the roguelike survival experience No Return, and more."
    },
    {
        id: 11,
        name: "Spiderman: Miles Morales",
        price: 350000,
        image: "./assets/img/spidermanmiles.png",
        category: "Playstation",
        description: "After the events of Marvel's Spider-Man Remastered, teenage Miles Morales is adjusting to his new home while following in the footsteps of his mentor, Peter Parker, as a new Spider-Man."
    },
    {
        id: 12,
        name: "Lynked: Banner of the Spark",
        price: 119999,
        image: "./assets/img/lynked.jpg",
        category: "Switch2",
        description: "Build your squad, choose abilities, and fight through a fractured kingdom in this tactical adventure."
    },
    {
        id: 13,
        name: "Jurassic World: Evolution 2",
        price: 749000,
        image: "./assets/img/jurrasic.jpg",
        category: "Playstation",
        description: "Create and manage your own dinosaur park with new systems, smarter creatures, and more customization."
    },
    {
        id: 14,
        name: "EA Sports FC 26",
        price: 350000,
        image: "./assets/img/fc26.jpg",
        category: "Switch2",
        description: "The Club is Yours in EA SPORTS FC™ 26. Play your way with an overhauled gameplay experience powered by community feedback, Manager Live Challenges that bring fresh storylines to the new season, and Archetypes inspired by greats of the game."
    },
    {
        id: 15,
        name: "Motogp 25",
        price: 350000,
        image: "./assets/img/motogp.jpg",
        category: "Switch2",
        description: "Race through official tracks with realistic bike handling and a full career mode."
    },
    {
        id: 16,
        name: "PlayStation 5 Digital Edition Slim",
        price: 8199000,
        image: "./assets/img/ps5.jpg",
        category: "Playstation",
        description: "The PS5 Slim offers fast loading, sharp visuals, and a compact build with a 1TB SSD."
    },
    {
        id: 17,
        name: "Nintendo Switch 2 Console - 512GB",
        price: 8099000,
        image: "./assets/img/switch2.jpg",
        category: "Switch2",
        description: "A new generation of hybrid gaming with better performance, improved display, and smooth portability."
    },
    {
        id: 18,
        name: "Nintendo Switch JoyCon - Green/Pink",
        price: 350000,
        image: "./assets/img/switch2joycon.jpg",
        category: "Switch2",
        description: "A stylish JoyCon pair with responsive controls, motion support, and HD Rumble."
    },
    {
        id: 19,
        name: "DualSense Wireless Controller - Starlight Blue",
        price: 1499000,
        image: "./assets/img/dualsense.jpg",
        category: "Playstation",
        description: "A PS5 controller with haptic feedback, adaptive triggers, and a clean Starlight Blue finish."
    },
    {
        id: 20,
        name: "Miyoo Mini Plus Retro Game Portable Handheld - Purple",
        price: 875000,
        image: "./assets/img/miyoo.jpg",
        category: "Other",
        description: "Miyoo Mini Plus Retro Game Console, Portable Handheld Open Source Game Console with Storage Case,3.5″ HD Display,Compatible with a Large Variety of Classic Games."
    },
    {
        id: 21,
        name: "KontrolFreek Performance Grips for PS4 - Inferno Red",
        price: 240000,
        image: "./assets/img/grips.jpg",
        category: "Playstation",
        description: "Anti-slip grips designed to improve comfort and control during intense gameplay."
    },
    {
        id: 22,
        name: "Nintendo Eshop Card USD $20 - Digital",
        price: 609000,
        image: "./assets/img/mario.jpg",
        category: "Switch2",
        description: "Add $20 credit to your Nintendo account for games, DLC, and digital content."
    },
    {
        id: 23,
        name: "Nintendo Eshop Card USD $35 - Digital",
        price: 609000,
        image: "./assets/img/princess.jpg",
        category: "Switch2",
        description: "Top up your Nintendo account with a $35 card for easy digital purchases."
    },
    {
        id: 24,
        name: "Nintendo Eshop Card USD $50 - Digital",
        price: 844000,
        image: "./assets/img/bowser.jpg",
        category: "Switch2",
        description: "Redeem $50 of eShop credit to buy games, add-ons, and other Nintendo content."
    },
    {
        id: 25,
        name: "Steam Wallet Gift Card (IDR 60.000) - Digital",
        price: 63300,
        image: "./assets/img/steam.jpg",
        category: "Other",
        description: "Add funds to your Steam account for games, items, and marketplace purchases."
    },
    {
        id: 26,
        name: "PlayStation Network Card IDR 200.000 - Digital",
        price: 303300,
        image: "./assets/img/psstore.jpg",
        category: "Playstation",
        description: "Redeem IDR 200.000 credit for PSN games, DLC, subscriptions, and more."
    },
    {
        id: 27,
        name: "PlayStation Network Card IDR 200.000 - Digital",
        price: 303300,
        image: "./assets/img/steam.jpg",
        category: "Other",
        description: "Instant digital code for PlayStation Store purchases worth IDR 200.000."
    },
    {
        id: 28,
        name: "Tekken 7",
        price: 599000,
        image: "./assets/img/tekken7.jpg",
        category: "Playstation",
        description: "One of the most successful fighting games in the world, Tekken 7 combines the adrenaline of the arcade with the precision of a fighting simulator."
    }
];