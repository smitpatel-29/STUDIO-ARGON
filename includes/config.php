<?php
// SITE CONFIGURATION
define('SITE_NAME', 'Studio Argon');
define('SITE_TAGLINE', 'Photorealistic 3D Architectural Rendering Studio');
define('SITE_EMAIL', 'hello@studioargon.com');
define('SITE_PHONE', '+1 234 567 8901');
define('SITE_ADDRESS', 'Gujarat, India');
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('BASE_URL', '/STUDIO%20ARGON/');
} else {
    define('BASE_URL', '/');
}

// NAVIGATION MENU
$nav_menu = [
    'Home' => 'index.php',
    'About' => 'about.php',
    'Services' => 'services.php',
    'Portfolio' => 'portfolio.php',
    'Blog' => 'blog.php',
    'Contact' => 'contact.php'
];

// SERVICES LIST
$services_list = [
    [
        'title' => '3D Exterior Rendering',
        'id' => '01',
        'desc' => 'Our photorealistic exterior rendering service transforms architectural drawings into stunning visuals that communicate the full character of a building. We capture materials, lighting, and landscape with extraordinary precision for residential and commercial projects of all scales.',
        'image' => 'assets/uploads/exterior.png',
        'tag' => 'Exterior',
        'deliverables' => [
            'Day & night view renders',
            'Aerial & drone-perspective views',
            'Street-level and context shots',
            'Material & color variation renders'
        ]
    ],
    [
        'title' => '3D Interior Rendering',
        'id' => '02',
        'desc' => 'We render interiors with meticulous attention to lighting physics, material textures, and furniture placement. Our renders convey not just how a space looks, but how it feels — creating an emotional connection with viewers before a single wall is built.',
        'image' => 'assets/uploads/service_interior.jpg',
        'tag' => 'Interior',
        'deliverables' => [
            'Living, bedroom, kitchen & bathroom views',
            'Multiple camera angles per room',
            'Furniture arrangement options',
            'Day / artificial lighting variations'
        ]
    ],
    [
        'title' => '3D Architectural Animation',
        'id' => '03',
        'desc' => 'Motion brings architecture to life like nothing else. Our cinematic animations take viewers on a journey through your project — from aerial approaches to interior walk-throughs — rendered in stunning 4K resolution with professional color grading.',
        'image' => 'assets/uploads/service_animation.jpg',
        'tag' => 'Animation',
        'deliverables' => [
            'Up to 4K resolution video output',
            'Narrated walkthrough option',
            'Drone-style aerial sequences',
            'MP4 / MOV delivery formats'
        ]
    ],
    [
        'title' => '3D Walkthrough Services',
        'id' => '04',
        'desc' => 'Give buyers and investors the ability to explore your development before it\'s built. Our interactive virtual walkthroughs place the viewer inside the space with full 360° freedom, supporting VR headsets and web-based tours for maximum accessibility.',
        'image' => 'assets/uploads/lakeside.png',
        'tag' => 'Walkthrough',
        'deliverables' => [
            'Full 360° panoramic views',
            'VR-ready format output',
            'Web-embeddable tour links',
            'Mobile-compatible players'
        ]
    ],
    [
        'title' => '3D Floor Plan Rendering',
        'id' => '05',
        'desc' => 'Clear, beautiful floor plan visualizations that help buyers and investors instantly understand the layout. We produce both 2D and 3D versions with accurate furniture placement, color coding, and dimensions — ready for brochures and sales presentations.',
        'image' => 'assets/uploads/future3d.png',
        'tag' => 'Floor Plan',
        'deliverables' => [
            'Color-coded room layouts',
            'Furniture & fixture placement',
            'Multiple floors in one project',
            'High-resolution PDF delivery'
        ]
    ],
    [
        'title' => 'Real Estate Renderings',
        'id' => '06',
        'desc' => 'Purpose-built for pre-construction marketing, our real estate renders are crafted for maximum visual impact across all marketing channels. Whether for a brochure, billboard, or Instagram campaign, we deliver visuals that drive enquiries and pre-sales.',
        'image' => 'assets/uploads/real_estate.png',
        'tag' => 'Real Estate',
        'deliverables' => [
            'Brochure-ready high-res images',
            'Billboard-size print exports',
            'Social media formatted assets',
            'Lifestyle context compositing'
        ]
    ]
];

// SOCIAL LINKS
$social_links = [
    'Instagram' => '#',
    'LinkedIn' => '#',
    'Behance' => '#',
    'YouTube' => '#'
];

// PORTFOLIO ITEMS
$portfolio_items = [
    [
        'title' => 'THE GLASS PAVILION',
        'category' => 'exterior',
        'image' => 'assets/uploads/glass_pavilion.png',
        'tools' => '3ds Max, V-Ray, Photoshop',
        'year' => '2025',
        'desc' => 'A conceptual glass pavilion focusing on transparency and reflection within a natural forest setting.'
    ],
    [
        'title' => 'MODERN ARCH',
        'category' => 'exterior',
        'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=1200',
        'tools' => 'Corona Renderer, Sketcup, Railclone',
        'year' => '2024',
        'desc' => 'Contemporary residential architecture featuring bold geometric forms and sustainable materials.'
    ],
    [
        'title' => 'LUXURY LOFT',
        'category' => 'interior',
        'image' => 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&q=80&w=1200',
        'tools' => '3ds Max, Corona, Forest Pack',
        'year' => '2025',
        'desc' => 'High-end industrial loft conversion with emphasis on raw materials and bespoke lighting fixtures.'
    ],
    [
        'title' => 'MINIMALIST SUITE',
        'category' => 'interior',
        'image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&q=80&w=1200',
        'tools' => '3ds Max, V-Ray, Lightroom',
        'year' => '2024',
        'desc' => 'A serene hotel suite design utilizing a monochromatic palette and natural wood textures.'
    ],
    [
        'title' => 'CITYSCAPE FLYTHROUGH',
        'category' => 'animation',
        'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=1200',
        'tools' => 'Unreal Engine 5, Premiere Pro',
        'year' => '2026',
        'desc' => 'Fast-paced cinematic flythrough of a planned urban development in a metropolitan business district.'
    ]
];

// BLOG POSTS
$blog_posts = [
    [
        'title' => 'How Strong Brand Identity Drives Real Estate Sales in 2025',
        'date' => 'Mar 15, 2025',
        'excerpt' => 'Discover how compelling architectural visualization directly impacts pre-construction unit sales and investor confidence in today\'s competitive market.',
        'image' => 'assets/uploads/blog/featured_brand.jpg',
        'category' => 'industry-trends',
        'tag' => 'Industry Trends',
        'author' => 'Alex Morgan',
        'author_img' => 'assets/uploads/avatar_julian.jpg'
    ],
    [
        'title' => 'Top 10 3D Rendering Software Tools for Architects',
        'date' => 'Feb 28, 2025',
        'excerpt' => 'A comprehensive comparison of the leading 3D rendering tools available in 2025 — from beginner-friendly platforms to professional-grade powerhouses.',
        'image' => 'assets/uploads/blog/tools_architect.jpg',
        'category' => 'software-guides',
        'tag' => 'Software Guides',
        'author' => 'Priya Sharma',
        'author_img' => 'assets/uploads/avatar_sarah.jpg'
    ],
    [
        'title' => 'Case Study: Luxury Villa Project from Blueprint to Final Render',
        'date' => 'Feb 10, 2025',
        'excerpt' => 'Behind the scenes of one of our most ambitious residential projects — from the first CAD file to the final photorealistic render delivered to the client.',
        'image' => 'assets/uploads/blog/villa_case_study.jpg',
        'category' => 'case-studies',
        'tag' => 'Case Studies',
        'author' => 'David Chen',
        'author_img' => 'assets/uploads/avatar_marc.jpg'
    ],
    [
        'title' => 'V-Ray vs Corona Renderer: Which is Better for Architectural Visualization?',
        'date' => 'Jan 22, 2025',
        'excerpt' => 'An honest, in-depth technical comparison of the two industry-leading render engines, evaluated on quality, speed, and ease of use for architectural projects.',
        'image' => 'assets/uploads/blog/vray_corona.jpg',
        'category' => 'rendering-tips',
        'tag' => 'Rendering Tips',
        'author' => 'Priya Sharma',
        'author_img' => 'assets/uploads/avatar_sarah.jpg'
    ],
    [
        'title' => 'How 3D Walkthroughs Are Changing Pre-Construction Marketing',
        'date' => 'Jan 08, 2025',
        'excerpt' => 'Interactive virtual tours are replacing physical show homes for savvy developers. We explore the data behind this shift and its impact on buyer engagement.',
        'image' => 'assets/uploads/blog/walkthrough_marketing.jpg',
        'category' => 'industry-trends',
        'tag' => 'Industry Trends',
        'author' => 'Alex Morgan',
        'author_img' => 'assets/uploads/avatar_julian.jpg'
    ],
    [
        'title' => '5 Common Mistakes Architects Make When Briefing a Rendering Studio',
        'date' => 'Dec 18, 2024',
        'excerpt' => 'After 10 years of client projects, we\'ve identified the five briefing mistakes that cause delays, unexpected costs, and disappointing results — and how to avoid them.',
        'image' => 'assets/uploads/blog/briefing_mistakes.jpg',
        'category' => 'rendering-tips',
        'tag' => 'Rendering Tips',
        'author' => 'Layla Hassan',
        'author_img' => 'assets/uploads/avatar_sarah.jpg'
    ],
    [
        'title' => 'Behind the Scenes: How We Rendered a 50-Floor Commercial Tower',
        'date' => 'Dec 03, 2024',
        'excerpt' => 'The technical and creative challenges of producing a full visual suite for one of the largest commercial tower projects in our studio\'s history.',
        'image' => 'assets/uploads/blog/tower_process.jpg',
        'category' => 'case-studies',
        'tag' => 'Case Studies',
        'author' => 'David Chen',
        'author_img' => 'assets/uploads/avatar_marc.jpg'
    ],
    [
        'title' => 'The Future of Real Estate: VR and AR in Architectural Visualization',
        'date' => 'Nov 20, 2024',
        'excerpt' => 'How virtual and augmented reality are reshaping the way buyers experience properties — and what studios need to offer to stay competitive in this new landscape.',
        'image' => 'assets/uploads/blog/future_vr_ar.jpg',
        'category' => 'industry-trends',
        'tag' => 'Industry Trends',
        'author' => 'Alex Morgan',
        'author_img' => 'assets/uploads/avatar_marc.jpg'
    ],
    [
        'title' => 'How to Prepare Your CAD Files for 3D Rendering',
        'date' => 'Nov 05, 2024',
        'excerpt' => 'A step-by-step technical guide for architects and designers on how to prepare and export CAD files that speed up the visualization process and improve render quality.',
        'image' => 'assets/uploads/blog/cad_prep.jpg',
        'category' => 'software-guides',
        'tag' => 'Software Guides',
        'author' => 'Priya Sharma',
        'author_img' => 'assets/uploads/avatar_sarah.jpg'
    ]
];

// FAQS
$faq_items = [
    [
        'q' => 'How long does a typical rendering project take?',
        'a' => 'Standard exterior or interior renders typically take 5–7 business days. Express delivery (3 days) and rush (24hrs) options are available at additional cost. Complex animation projects require 2–4 weeks depending on duration and detail level.'
    ],
    [
        'q' => 'What files do I need to provide?',
        'a' => 'We work with CAD files (.dwg, .dxf), Revit (.rvt), SketchUp (.skp), 3ds Max (.max), and PDFs. The more detailed your drawings, the more accurate and efficient the process. We also accept reference images and material specs.'
    ],
    [
        'q' => 'How many revision rounds are included?',
        'a' => 'All projects include 2 round of revisions as standard. Additional revision rounds can be added at a nominal fee. We find that most projects are approved within 1–2 rounds with clear upfront briefing.'
    ],
    [
        'q' => 'Do you offer rush delivery?',
        'a' => 'Yes! We offer Express (3-day) and Rush (24-hour) delivery options. Rush slots are subject to availability and carry a premium surcharge. Contact us to check current availability before your deadline.'
    ],
    [
        'q' => 'What resolution are the final renders delivered at?',
        'a' => 'Standard renders are delivered at 4K resolution (3840×2160) in TIFF and JPEG formats. Billboard-ready exports (up to 10,000px wide) are available on request. All files include full commercial usage rights.'
    ],
    [
        'q' => 'Do you sign NDAs for confidential projects?',
        'a' => 'Absolutely. We sign NDAs on request for all confidential pre-launch projects. Client confidentiality is a cornerstone of how we operate — many of our most prestigious projects are under permanent NDA.'
    ]
];
?>
