@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.guest.navbar', ['title' => 'AI Indices'])
    
    <style>
        .ai-indices-page {
            --ai-menablue: #022248;
            --ai-hover-blue: #0052a3;
            --ai-accent: #f39c12;
            --ai-gradient-1: #022248;
            --ai-gradient-2: #0a4d8a;
            --ai-gradient-3: #1565c0;
        }

        /* Enhanced Hero with Animated Gradient */
        .ai-hero-page {
            background: linear-gradient(-45deg, var(--ai-gradient-1), var(--ai-gradient-2), var(--ai-gradient-3), var(--ai-gradient-1));
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .ai-hero-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .ai-hero-page h1 {
            color: #fff;
            text-align: center;
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            letter-spacing: 2px;
            position: relative;
        }

        .ai-hero-intro {
            text-align: center;
            color: rgba(255,255,255,0.9);
            max-width: 700px;
            margin: 0 auto 40px;
            font-size: 1.15rem;
            line-height: 1.7;
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .hero-stat {
            text-align: center;
            padding: 20px 30px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .hero-stat:hover {
            transform: translateY(-5px);
            background: rgba(255,255,255,0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .hero-stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            display: block;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.8);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        .ai-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .map-controls {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 25px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1), 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.8);
            position: relative;
        }

        .map-controls::before {
            content: 'Select Index & Year';
            position: absolute;
            top: -12px;
            left: 25px;
            background: var(--ai-menablue);
            color: white;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .control-group label {
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .control-group select,
        .control-group button {
            padding: 10px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            color: #333;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .control-group select:hover,
        .control-group button:hover {
            border-color: var(--ai-menablue);
            box-shadow: 0 2px 8px rgba(0,102,204,0.15);
        }

        .control-group button {
            background: var(--ai-menablue);
            color: white;
            border: none;
            font-weight: 600;
        }

        .control-group button:hover {
            background: var(--ai-hover-blue);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,102,204,0.25);
        }

        .map-wrapper {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        #ai-map {
            height: 600px;
            width: 100%;
            border-radius: 12px;
            z-index: 1;
        }

        .ai-legend {
            position: absolute;
            bottom: 30px;
            right: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            z-index: 1000;
            min-width: 220px;
        }

        .ai-legend h4 {
            margin: 0 0 12px 0;
            font-size: 1rem;
            color: #333;
            font-weight: 700;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 8px 0;
            font-size: 0.9rem;
            color: #333;
        }

        .legend-item span {
            color: #333 !important;
        }

        .legend-color {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            margin-right: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stats-panel {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--ai-menablue), var(--ai-accent));
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(2, 34, 72, 0.15);
        }

        .stat-card:nth-child(1)::before {
            background: linear-gradient(90deg, #3498db, #2980b9);
        }

        .stat-card:nth-child(2)::before {
            background: linear-gradient(90deg, #2ecc71, #27ae60);
        }

        .stat-card:nth-child(3)::before {
            background: linear-gradient(90deg, #f39c12, #e67e22);
        }

        .stat-card:nth-child(4)::before {
            background: linear-gradient(90deg, #9b59b6, #8e44ad);
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            display: block;
        }

        .stat-card h3 {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .stat-card .value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--ai-menablue);
            line-height: 1.2;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .popup-content {
            padding: 10px;
        }

        .popup-content h3 {
            margin: 0 0 12px 0;
            color: var(--ai-menablue);
            font-size: 1.2rem;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 8px;
        }

        .popup-content .metric {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 6px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .popup-content .metric:last-child {
            border-bottom: none;
        }

        .popup-content .metric-label {
            font-weight: 600;
            color: #555;
        }

        .popup-content .metric-value {
            color: var(--ai-menablue);
            font-weight: 700;
        }

        .source-footer {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 12px;
            margin-top: 20px;
            border-left: 4px solid var(--ai-menablue);
        }

        .source-footer p {
            margin: 0;
            font-size: 0.9rem;
            color: #555;
        }

        .source-footer a {
            color: var(--ai-menablue);
            text-decoration: underline;
            font-weight: 600;
        }

        .source-footer a:hover {
            color: var(--ai-hover-blue);
        }

        .data-table-container {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-top: 30px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-header h3 {
            margin: 0;
            font-size: 1.3rem;
            color: var(--ai-menablue);
            font-weight: 700;
        }

        .table-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .table-search {
            padding: 10px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.9rem;
            width: 200px;
            transition: all 0.3s ease;
        }

        .table-search:focus {
            outline: none;
            border-color: var(--ai-menablue);
            box-shadow: 0 0 0 3px rgba(2, 34, 72, 0.1);
        }

        .export-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        .data-table-scroll {
            max-height: 500px;
            overflow-y: auto;
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.9rem;
        }

        .data-table th,
        .data-table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .data-table th {
            background: linear-gradient(135deg, var(--ai-menablue), #0a4d8a);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .data-table th:hover {
            background: linear-gradient(135deg, #0a4d8a, var(--ai-menablue));
        }

        .data-table th:first-child {
            border-radius: 12px 0 0 0;
        }

        .data-table th:last-child {
            border-radius: 0 12px 0 0;
        }

        .data-table tr {
            transition: all 0.2s ease;
        }

        .data-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(2, 34, 72, 0.03), transparent);
            transform: scale(1.01);
        }

        .data-table td:first-child {
            font-weight: 700;
            color: var(--ai-menablue);
        }

        .data-table tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        .data-table tbody tr:nth-child(even):hover {
            background: linear-gradient(90deg, rgba(2, 34, 72, 0.05), rgba(250, 251, 252, 0.5));
        }

        .aidv-info-box {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            border-left: 4px solid #e74c3c;
        }

        .aidv-info-box h5 {
            margin: 0 0 10px 0;
            color: #333;
            font-weight: 700;
        }

        .aidv-info-box p {
            margin: 0;
            color: #555;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Fullscreen Map Button */
        .fullscreen-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1001;
            padding: 12px 16px;
            background: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .fullscreen-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        .map-wrapper.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            border-radius: 0;
            padding: 0;
        }

        .map-wrapper.fullscreen #ai-map {
            height: 100vh;
            border-radius: 0;
        }

        /* Marker Animation */
        @keyframes markerPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .custom-marker > div:hover {
            animation: markerPulse 0.5s ease;
        }

        /* Animated Counter */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in {
            animation: countUp 0.6s ease forwards;
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @media (max-width: 768px) {
            .ai-hero-page {
                padding: 50px 15px;
            }

            .ai-hero-page h1 {
                font-size: 2rem;
            }

            .ai-hero-intro {
                font-size: 1rem;
            }

            .hero-stats {
                gap: 20px;
            }

            .hero-stat {
                padding: 15px 20px;
            }

            .hero-stat-value {
                font-size: 1.8rem;
            }

            .map-controls {
                flex-direction: column;
                align-items: stretch;
                padding: 20px;
            }

            .map-controls::before {
                left: 15px;
            }

            .control-group {
                flex-direction: column;
                align-items: stretch;
            }

            #ai-map {
                height: 450px;
            }

            .ai-legend {
                bottom: 20px;
                right: 20px;
                left: 20px;
                min-width: auto;
            }

            .stats-panel {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                text-align: center;
            }

            .table-actions {
                flex-direction: column;
                width: 100%;
            }

            .table-search {
                width: 100%;
            }
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="ai-indices-page">
        <div class="ai-hero-page">
            <div class="ai-container">
                <h1>@lang('translation.ai-indices', ['default' => 'MENA AI Indices'])</h1>
                <div class="ai-hero-intro">
                    <p>Explore comprehensive AI adoption and innovation metrics across the Middle East and North Africa region. Interactive visualization of AI readiness, investment, and development indicators.</p>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat animate-in" style="animation-delay: 0.1s;">
                        <span class="hero-stat-value" id="hero-indices-count">5</span>
                        <span class="hero-stat-label">AI Indices</span>
                    </div>
                    <div class="hero-stat animate-in" style="animation-delay: 0.2s;">
                        <span class="hero-stat-value" id="hero-countries-count">20+</span>
                        <span class="hero-stat-label">Countries</span>
                    </div>
                    <div class="hero-stat animate-in" style="animation-delay: 0.3s;">
                        <span class="hero-stat-value" id="hero-years-count">4</span>
                        <span class="hero-stat-label">Years of Data</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="ai-container">
            <div class="map-controls">
                <div class="control-group">
                    <label for="index-select">Index:</label>
                    <select id="index-select">
                        <option value="globalAI">The Global AI Index (Tortoise Media)</option>
                        <option value="govReadiness">Government AI Readiness Index (Oxford Insights)</option>
                        <option value="girai">Global Index on Responsible AI - GIRAI</option>
                        <option value="aipi">AI Preparedness Index - AIPI (IMF)</option>
                        <option value="aidv">AI and Democratic Values Index - AIDV (CAIDP)</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="year-select">Year:</label>
                    <select id="year-select">
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="control-group">
                    <button onclick="resetMap()">Reset View</button>
                </div>
            </div>

            <div class="map-wrapper" id="map-wrapper">
                <button class="fullscreen-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen">⛶</button>
                <div id="ai-map"></div>
                <div class="ai-legend">
                    <h4>Score Range</h4>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #1a9850;"></div>
                        <span>High (80-100)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #91cf60;"></div>
                        <span>Medium-High (60-79)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #fee08b;"></div>
                        <span>Medium (40-59)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #fc8d59;"></div>
                        <span>Medium-Low (20-39)</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #d73027;"></div>
                        <span>Low (0-19)</span>
                    </div>
                </div>
            </div>

            <!-- Source and Methodology Footer -->
            <div class="source-footer" id="source-footer">
                <p id="source-text"></p>
            </div>

            <!-- Data Table -->
            <div class="data-table-container">
                <div class="table-header">
                    <h3>Country Data</h3>
                    <div class="table-actions">
                        <input type="text" class="table-search" id="table-search" placeholder="Search countries..." oninput="filterTable()">
                        <button class="export-btn" onclick="exportToCSV()">
                            Export CSV
                        </button>
                    </div>
                </div>
                <div class="data-table-scroll">
                    <table class="data-table" id="data-table">
                        <thead id="table-header">
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- AIDV Info Box (shown only for AIDV index) -->
            <div class="aidv-info-box" id="aidv-info" style="display: none;">
                <h5>About the AI and Democratic Values Index</h5>
                <p>The Artificial Intelligence and Democratic Values Index (AIDV) assesses countries based on their commitment to responsible AI development aligned with democratic principles, human rights, and ethical governance. Countries are evaluated on their AI policies, regulatory frameworks, and alignment with international AI ethics standards.</p>
            </div>

            <div class="stats-panel">
                <div class="stat-card">

                    <h3>Average Score</h3>
                    <div class="value" id="avg-index">--</div>
                </div>
                <div class="stat-card">

                    <h3>Countries Tracked</h3>
                    <div class="value" id="country-count">--</div>
                </div>
                <div class="stat-card">

                    <h3>Highest Score</h3>
                    <div class="value" id="highest-score">--</div>
                </div>
                <div class="stat-card">

                    <h3>Top Performer</h3>
                    <div class="value" style="font-size: 1.5rem;" id="top-country">--</div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.guest.footer')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Country coordinates
        const countryCoords = {
            'Morocco': [31.7917, -7.0926],
            'Algeria': [28.0339, 1.6596],
            'Tunisia': [33.8869, 9.5375],
            'Libya': [26.3351, 17.2283],
            'Egypt': [26.8206, 30.8025],
            'Sudan': [15.5007, 32.5599],
            'Jordan': [30.5852, 36.2384],
            'Lebanon': [33.8547, 35.8623],
            'Syria': [34.8021, 38.9968],
            'Palestine': [31.9522, 35.2332],
            'Saudi Arabia': [23.8859, 45.0792],
            'Bahrain': [26.0667, 50.5577],
            'Kuwait': [29.3117, 47.4818],
            'UAE': [24.4539, 54.3773],
            'Qatar': [25.3548, 51.1839],
            'Oman': [21.4735, 55.9754],
            'Yemen': [15.5527, 48.5164],
            'Iraq': [33.2232, 43.6793],
            'Somalia': [5.1521, 46.1996]
        };

        // Index metadata
        const indexMeta = {
            globalAI: {
                name: 'The Global AI Index (2024) by Tortoise Media',
                years: ['2024'],
                source: 'Scores are sourced from The Global AI Index (2024) by Tortoise Media.',
                methodologyUrl: 'https://www.tortoisemedia.com/_app/immutable/assets/AI-Methodology-2409.DOT1U7Pc.pdf',
                columns: ['Total Score', 'Talent', 'Infrastructure', 'Operating Environment', 'Research', 'Development', 'Government Strategy', 'Commercial']
            },
            govReadiness: {
                name: 'Government AI Readiness Index by Oxford Insights',
                years: ['2024', '2023', '2022', '2021'],
                source: 'Scores are sourced from the Government AI Readiness Index by Oxford Insights.',
                methodologyUrl: 'https://oxfordinsights.com/ai-readiness/ai-readiness-index/',
                columns: ['Total Score', 'Vision', 'Governance & Ethics', 'Adaptability', 'Digital Capacity', 'Maturity', 'Innovation Capacity', 'Human Capital', 'Infrastructure', 'Data Availability', 'Data Representativeness']
            },
            girai: {
                name: 'Global Index on Responsible AI (GIRAI) (2024) by Global Center on AI Governance',
                years: ['2024'],
                source: 'Scores are sourced from the Global Index on Responsible AI (GIRAI) (2024) by Global Center on AI Governance.',
                methodologyUrl: 'https://www.global-index.ai/methodology',
                columns: ['Total Score', 'Government Framework', 'Discourse Actions', 'Non-State Actors', 'Human Rights & AI', 'Responsible AI Capabilities', 'Responsible AI Governance']
            },
            aipi: {
                name: 'AI Preparedness Index (AIPI) (2023) by the International Monetary Fund (IMF)',
                years: ['2023'],
                source: 'Scores are sourced from the AI Preparedness Index (AIPI) (2023) by the International Monetary Fund (IMF).',
                methodologyUrl: 'https://www.imf.org/en/external/datamapper/datasets/AIPI/view',
                columns: ['AI Preparedness Index', 'Digital Infrastructure', 'Human Capital', 'Innovation & Economic Integration', 'Regulation & Ethics']
            },
            aidv: {
                name: 'Artificial Intelligence and Democratic Values Index (AIDV) by Center for AI and Digital Policy (CAIDP)',
                years: ['2025', '2023', '2022', '2021'],
                source: 'Scores are sourced from the Artificial Intelligence and Democratic Values Index (AIDV) (2025) by Center for AI and Digital Policy (CAIDP).',
                methodologyUrl: 'https://www.caidp.org/reports/aidv-index-2025/',
                columns: ['2025 Score', 'Tier', 'Status']
            }
        };

        // Complete data for all indices
        const indexData = {
            globalAI: {
                '2024': {
                    'Saudi Arabia': { totalScore: 20, talent: 6, infrastructure: 23, operatingEnv: 59, research: 3, development: 7, govStrategy: 100, commercial: 21 },
                    'UAE': { totalScore: 17, talent: 6, infrastructure: 29, operatingEnv: 57, research: 11, development: 14, govStrategy: 31, commercial: 13 },
                    'Egypt': { totalScore: 8, talent: 3, infrastructure: 16, operatingEnv: 72, research: 2, development: 0, govStrategy: 38, commercial: 2 },
                    'Qatar': { totalScore: 8, talent: 4, infrastructure: 22, operatingEnv: 36, research: 3, development: 0, govStrategy: 30, commercial: 0 },
                    'Iran': { totalScore: 7, talent: 3, infrastructure: 14, operatingEnv: 33, research: 3, development: 2, govStrategy: 6, commercial: 7 },
                    'Bahrain': { totalScore: 7, talent: 2, infrastructure: 19, operatingEnv: 49, research: 2, development: 0, govStrategy: 36, commercial: 0 },
                    'Jordan': { totalScore: 7, talent: 2, infrastructure: 20, operatingEnv: 36, research: 3, development: 3, govStrategy: 21, commercial: 1 },
                    'Oman': { totalScore: 6, talent: 1, infrastructure: 18, operatingEnv: 36, research: 1, development: 0, govStrategy: 36, commercial: 0 },
                    'Tunisia': { totalScore: 5, talent: 4, infrastructure: 14, operatingEnv: 35, research: 2, development: 0, govStrategy: 15, commercial: 2 },
                    'Iraq': { totalScore: 4, talent: 1, infrastructure: 15, operatingEnv: 37, research: 1, development: 1, govStrategy: 3, commercial: 0 },
                    'Morocco': { totalScore: 4, talent: 3, infrastructure: 16, operatingEnv: 49, research: 1, development: 1, govStrategy: 10, commercial: 0 },
                    'Algeria': { totalScore: 4, talent: 2, infrastructure: 14, operatingEnv: 40, research: 1, development: 0, govStrategy: 10, commercial: 0 }
                }
            },
            govReadiness: {
                '2024': {
                    'UAE': { totalScore: 75.66, vision: 83.89, govEthics: 100, adaptability: 78.89, digitalCapacity: 65.37, maturity: 91.3, innovationCapacity: 67.26, humanCapital: 72.75, infrastructure: 83.89, dataAvailability: 74.96, dataRepresentativeness: 97 },
                    'Saudi Arabia': { totalScore: 72.28, vision: 80.72, govEthics: 100, adaptability: 74.88, digitalCapacity: 69.77, maturity: 78.24, innovationCapacity: 61.69, humanCapital: 65.41, infrastructure: 83.43, dataAvailability: 90.19, dataRepresentativeness: 86.39 },
                    'Qatar': { totalScore: 69.22, vision: 79.07, govEthics: 100, adaptability: 79.29, digitalCapacity: 34.4, maturity: 36.49, innovationCapacity: 55.06, humanCapital: 54.18, infrastructure: 81.69, dataAvailability: 76.34, dataRepresentativeness: 99.65 },
                    'Oman': { totalScore: 62.91, vision: 69.61, govEthics: 100, adaptability: 56.17, digitalCapacity: 53.76, maturity: 68.49, innovationCapacity: 47.61, humanCapital: 55.84, infrastructure: 77.84, dataAvailability: 83.65, dataRepresentativeness: 88.88 },
                    'India': { totalScore: 62.81, vision: 75.52, govEthics: 100, adaptability: 80.05, digitalCapacity: 50.08, maturity: 68.17, innovationCapacity: 63.76, humanCapital: 51.76, infrastructure: 64.76, dataAvailability: 67.48, dataRepresentativeness: 82.96 },
                    'Jordan': { totalScore: 61.57, vision: 74.92, govEthics: 100, adaptability: 75.82, digitalCapacity: 50.65, maturity: 71.83, innovationCapacity: 56.04, humanCapital: 52.46, infrastructure: 67.14, dataAvailability: 78.34, dataRepresentativeness: 82.38 },
                    'Egypt': { totalScore: 55.63, vision: 68.89, govEthics: 100, adaptability: 70.02, digitalCapacity: 47.57, maturity: 58.34, innovationCapacity: 61.21, humanCapital: 47.33, infrastructure: 55.77, dataAvailability: 30.61, dataRepresentativeness: 81.8 },
                    'Bahrain': { totalScore: 54.23, vision: 45.62, govEthics: 0, adaptability: 57.07, digitalCapacity: 61.74, maturity: 63.67, innovationCapacity: 43.46, humanCapital: 39.81, infrastructure: 79.76, dataAvailability: 84.11, dataRepresentativeness: 92.42 },
                    'Kuwait': { totalScore: 51.28, vision: 49.29, govEthics: 50, adaptability: 59.5, digitalCapacity: 42.12, maturity: 40.24, innovationCapacity: 37.49, humanCapital: 39.82, infrastructure: 70.36, dataAvailability: 62.82, dataRepresentativeness: 90.15 },
                    'Lebanon': { totalScore: 46.67, vision: 51.09, govEthics: 100, adaptability: 38.86, digitalCapacity: 30.03, maturity: 34.89, innovationCapacity: 50.53, humanCapital: 55.58, infrastructure: 48.48, dataAvailability: 44.37, dataRepresentativeness: 69.84 },
                    'Iran': { totalScore: 43.88, vision: 28.54, govEthics: 0, adaptability: 38.19, digitalCapacity: 23.17, maturity: 44.81, innovationCapacity: 47.64, humanCapital: 47.64, infrastructure: 66.29, dataAvailability: 82.2, dataRepresentativeness: 75.03 },
                    'Tunisia': { totalScore: 41.68, vision: 39.62, govEthics: 0, adaptability: 53.9, digitalCapacity: 27.37, maturity: 44.52, innovationCapacity: 46.23, humanCapital: 36.31, infrastructure: 61.35, dataAvailability: 74.12, dataRepresentativeness: 75.5 },
                    'Morocco': { totalScore: 41.78, vision: 54.82, govEthics: 0, adaptability: 56.95, digitalCapacity: 43.86, maturity: 38.56, innovationCapacity: 49.82, humanCapital: 40.63, infrastructure: 53.82, dataAvailability: 51.28, dataRepresentativeness: 72.22 },
                    'Algeria': { totalScore: 41.61, vision: 46.98, govEthics: 0, adaptability: 54.25, digitalCapacity: 29.39, maturity: 53.1, innovationCapacity: 80.25, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Libya': { totalScore: 45.03, vision: 44.49, govEthics: 0, adaptability: 52.24, digitalCapacity: 29.72, maturity: 55.05, innovationCapacity: 71.94, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Palestine': { totalScore: 45.56, vision: 37.27, govEthics: 0, adaptability: 55.21, digitalCapacity: 33.24, maturity: 56.05, innovationCapacity: 76.35, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Iraq': { totalScore: 40.91, vision: 32.6, govEthics: 50, adaptability: 19.41, digitalCapacity: 40.1, maturity: 20.9, innovationCapacity: 41.61, humanCapital: 46.98, infrastructure: 54.25, dataAvailability: 19.02, dataRepresentativeness: 29.99 },
                    'Syria': { totalScore: 40.33, vision: 42.26, govEthics: 0, adaptability: 48.8, digitalCapacity: 34.92, maturity: 30.69, innovationCapacity: 80.8, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Somalia': { totalScore: 25.32, vision: 19.03, govEthics: 0, adaptability: 30.46, digitalCapacity: 23.92, maturity: 21.82, innovationCapacity: 5.83, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Sudan': { totalScore: 24.83, vision: 13.52, govEthics: 0, adaptability: 14.18, digitalCapacity: 23.94, maturity: 13.19, innovationCapacity: 3.22, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null },
                    'Yemen': { totalScore: 28.33, vision: 26.94, govEthics: 0, adaptability: 36.54, digitalCapacity: 16.53, maturity: 35.31, innovationCapacity: 57.79, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null }
                },
                '2023': {
                    'UAE': { totalScore: 68.54, vision: 71.52, govEthics: 100, adaptability: 49.35, digitalCapacity: 55.04, maturity: 52.23, innovationCapacity: 63.61, humanCapital: 74.92, infrastructure: 64.77, dataAvailability: 65.31, dataRepresentativeness: 91.07 },
                    'Qatar': { totalScore: 63.90, vision: 70.74, govEthics: 100, adaptability: 40.55, digitalCapacity: 65.88, maturity: 46.17, innovationCapacity: 56.51, humanCapital: 61.14, infrastructure: 74.62, dataAvailability: 51.41, dataRepresentativeness: 89.83 },
                    'Saudi Arabia': { totalScore: 61.96, vision: 59.08, govEthics: 100, adaptability: 40.77, digitalCapacity: 59.11, maturity: 47.41, innovationCapacity: 46.77, humanCapital: 56, infrastructure: 49.06, dataAvailability: 67.04, dataRepresentativeness: 91.08 },
                    'Bahrain': { totalScore: 51.59, vision: 65.14, govEthics: 0, adaptability: 51.96, digitalCapacity: 56.22, maturity: 17.86, innovationCapacity: 21.5, humanCapital: 62.16, infrastructure: 71.48, dataAvailability: 13.89, dataRepresentativeness: 85.22 },
                    'Jordan': { totalScore: 51.76, vision: 47.24, govEthics: 100, adaptability: 41.38, digitalCapacity: 40.46, maturity: 34.11, innovationCapacity: 43.23, humanCapital: 52.55, infrastructure: 16.98, dataAvailability: 73.95, dataRepresentativeness: 85.05 },
                    'Tunisia': { totalScore: 51.08, vision: 44.24, govEthics: 100, adaptability: 42.39, digitalCapacity: 36.08, maturity: 36.24, innovationCapacity: 33.16, humanCapital: 42.79, infrastructure: 11.48, dataAvailability: 65.8, dataRepresentativeness: 82.22 },
                    'Egypt': { totalScore: 49.42, vision: 57.46, govEthics: 100, adaptability: 51.42, digitalCapacity: 41.72, maturity: 36.97, innovationCapacity: 16.65, humanCapital: 51.82, infrastructure: 15.26, dataAvailability: 73.95, dataRepresentativeness: 72.68 },
                    'Oman': { totalScore: 49.45, vision: 48.06, govEthics: 0, adaptability: 41.37, digitalCapacity: 39.31, maturity: 34.11, innovationCapacity: 44.74, humanCapital: 66.97, infrastructure: 31.21, dataAvailability: 46.72, dataRepresentativeness: 70.53 },
                    'Morocco': { totalScore: 44.95, vision: 38.36, govEthics: 0, adaptability: 41.09, digitalCapacity: 33.76, maturity: 31.25, innovationCapacity: 34.11, humanCapital: 60.93, infrastructure: 51.17, dataAvailability: 65.8, dataRepresentativeness: 72.68 },
                    'Lebanon': { totalScore: 45.77, vision: 54.86, govEthics: 0, adaptability: 62.32, digitalCapacity: 41.03, maturity: 36.09, innovationCapacity: 31.34, humanCapital: 39.83, infrastructure: 0, dataAvailability: 60.08, dataRepresentativeness: 88.08 },
                    'Kuwait': { totalScore: 40.81, vision: 18.19, govEthics: 0, adaptability: 42.45, digitalCapacity: 43.66, maturity: 35.01, innovationCapacity: 24.69, humanCapital: 43.66, infrastructure: 46.91, dataAvailability: 37.97, dataRepresentativeness: 74.93 },
                    'Algeria': { totalScore: 35.18, vision: 36.17, govEthics: 0, adaptability: 28.84, digitalCapacity: 40.0, maturity: 39.02, innovationCapacity: 16.79, humanCapital: 37.62, infrastructure: 64.04, dataAvailability: 43.56, dataRepresentativeness: 47.08 },
                    'Libya': { totalScore: 28.86, vision: 12.22, govEthics: 0, adaptability: 28.35, digitalCapacity: 25.75, maturity: 29.87, innovationCapacity: 12.26, humanCapital: 29.5, infrastructure: 17.96, dataAvailability: 47.45, dataRepresentativeness: 45.77 },
                    'Iraq': { totalScore: 31.97, vision: 27.56, govEthics: 0, adaptability: 35.83, digitalCapacity: 32.52, maturity: 34.17, innovationCapacity: 20.57, humanCapital: 27.5, infrastructure: 37.41, dataAvailability: 47.55, dataRepresentativeness: 62.2 },
                    'Sudan': { totalScore: 21.91, vision: 18.66, govEthics: 0, adaptability: 27.88, digitalCapacity: 26.41, maturity: 8.18, innovationCapacity: 4.09, humanCapital: 25.49, infrastructure: 13.64, dataAvailability: 26.25, dataRepresentativeness: 71.57 },
                    'Yemen': { totalScore: 17.37, vision: 19.38, govEthics: 0, adaptability: 5.7, digitalCapacity: 14.80, maturity: 10.27, innovationCapacity: 5.01, humanCapital: 18.80, infrastructure: 16.02, dataAvailability: 14.41, dataRepresentativeness: 4.71 }
                },
                '2022': {
                    'UAE': { totalScore: 71.8, vision: 79.81, govEthics: 100, adaptability: 67.96, digitalCapacity: 79.91, maturity: 58.08, innovationCapacity: 86.70, humanCapital: 21.18, infrastructure: 57.47, dataAvailability: 50.64, dataRepresentativeness: 89.83 },
                    'Saudi Arabia': { totalScore: 61.82, vision: 57.24, govEthics: 100, adaptability: 68.11, digitalCapacity: 61.08, maturity: 51.55, innovationCapacity: 30.12, humanCapital: 71.09, infrastructure: 43, dataAvailability: 55.02, dataRepresentativeness: 76.28 },
                    'Qatar': { totalScore: 62.29, vision: 64.08, govEthics: 100, adaptability: 44.59, digitalCapacity: 69.07, maturity: 43.13, innovationCapacity: 43.52, humanCapital: 36, infrastructure: 81.01, dataAvailability: 49.04, dataRepresentativeness: 77.49 },
                    'Bahrain': { totalScore: 57.29, vision: 51.46, govEthics: 0, adaptability: 48.99, digitalCapacity: 70.28, maturity: 30.20, innovationCapacity: 45.52, humanCapital: 34.87, infrastructure: 65.21, dataAvailability: 17.45, dataRepresentativeness: 81.05 },
                    'Jordan': { totalScore: 52.73, vision: 77.96, govEthics: 50, adaptability: 48.32, digitalCapacity: 38.01, maturity: 46.72, innovationCapacity: 44.74, humanCapital: 54.11, infrastructure: 34.31, dataAvailability: 47.75, dataRepresentativeness: 85.29 },
                    'Kuwait': { totalScore: 51.61, vision: 36.56, govEthics: 50, adaptability: 76.3, digitalCapacity: 56.96, maturity: 55.11, innovationCapacity: 46.29, humanCapital: 36, infrastructure: 57.27, dataAvailability: 65.06, dataRepresentativeness: 90.04 },
                    'Tunisia': { totalScore: 48.95, vision: 38.36, govEthics: 0, adaptability: 44.09, digitalCapacity: 33.47, maturity: 36.11, innovationCapacity: 35.11, humanCapital: 60.2, infrastructure: 51.19, dataAvailability: 60.04, dataRepresentativeness: 40.17 },
                    'Oman': { totalScore: 50.49, vision: 42.53, govEthics: 0, adaptability: 76.38, digitalCapacity: 56.96, maturity: 55.11, innovationCapacity: 56.56, humanCapital: 51.27, infrastructure: 43.15, dataAvailability: 47.08, dataRepresentativeness: 46.53 },
                    'Egypt': { totalScore: 46.40, vision: 42.53, govEthics: 0, adaptability: 56.38, digitalCapacity: 47.01, maturity: 46.11, innovationCapacity: 26.76, humanCapital: 34.26, infrastructure: 43.15, dataAvailability: 47.25, dataRepresentativeness: 63.22 },
                    'Morocco': { totalScore: 40.49, vision: 42.53, govEthics: 0, adaptability: 26.51, digitalCapacity: 43.77, maturity: 36.31, innovationCapacity: 26.56, humanCapital: 27.72, infrastructure: 57.25, dataAvailability: 63.04, dataRepresentativeness: 41.17 },
                    'Lebanon': { totalScore: 41.07, vision: 54.16, govEthics: 0, adaptability: 51.18, digitalCapacity: 41.33, maturity: 61.31, innovationCapacity: 47.48, humanCapital: 45.06, infrastructure: 17.32, dataAvailability: 43.46, dataRepresentativeness: 47.68 },
                    'Algeria': { totalScore: 31.97, vision: 27.96, govEthics: 0, adaptability: 21.07, digitalCapacity: 32.52, maturity: 29.01, innovationCapacity: 16.06, humanCapital: 17.32, infrastructure: 34.31, dataAvailability: 47.45, dataRepresentativeness: 47.08 },
                    'Libya': { totalScore: 28.84, vision: 10.96, govEthics: 0, adaptability: 32.04, digitalCapacity: 18.68, maturity: 8.06, innovationCapacity: 8.94, humanCapital: 17.42, infrastructure: 47.07, dataAvailability: 16.53, dataRepresentativeness: 71.95 },
                    'Iraq': { totalScore: 27.94, vision: 13.63, govEthics: 0, adaptability: 19.78, digitalCapacity: 45.86, maturity: 9.62, innovationCapacity: 9.01, humanCapital: 26.94, infrastructure: 12.12, dataAvailability: 6.53, dataRepresentativeness: 4.71 },
                    'Sudan': { totalScore: 23.94, vision: 13.63, govEthics: 0, adaptability: 17.98, digitalCapacity: 25.47, maturity: 6.33, innovationCapacity: 5.01, humanCapital: 26.94, infrastructure: 16.02, dataAvailability: 14.41, dataRepresentativeness: 4.71 }
                },
                '2021': {
                    'UAE': { totalScore: 77.42, vision: 78.30, govEthics: 100, adaptability: 69.21, digitalCapacity: 55.18, maturity: 58.80, innovationCapacity: 58.47, humanCapital: 24.76, infrastructure: 62.86, dataAvailability: 72.28, dataRepresentativeness: 76.18 },
                    'Saudi Arabia': { totalScore: 71.85, vision: 78.71, govEthics: 100, adaptability: 100, digitalCapacity: 43.45, maturity: 40.25, innovationCapacity: 28.93, humanCapital: 31.05, infrastructure: 61.89, dataAvailability: 53.02, dataRepresentativeness: 67.5 },
                    'Qatar': { totalScore: 62.50, vision: 64.04, govEthics: 100, adaptability: 25.18, digitalCapacity: 40.55, maturity: 17.42, innovationCapacity: 30.46, humanCapital: 81.49, infrastructure: 69.08, dataAvailability: 40.62, dataRepresentativeness: 60.9 },
                    'Oman': { totalScore: 56.86, vision: 63.55, govEthics: 100, adaptability: 26.57, digitalCapacity: 40.56, maturity: 39.54, innovationCapacity: 21.12, humanCapital: 27.2, infrastructure: 45.17, dataAvailability: 47.28, dataRepresentativeness: 74.63 },
                    'Bahrain': { totalScore: 56.11, vision: 47.98, govEthics: 100, adaptability: 25.53, digitalCapacity: 35.51, maturity: 25.31, innovationCapacity: 23.36, humanCapital: 27.99, infrastructure: 45.15, dataAvailability: 62.77, dataRepresentativeness: 80.53 },
                    'Jordan': { totalScore: 48.37, vision: 47.46, govEthics: 0, adaptability: 23.51, digitalCapacity: 31.55, maturity: 46.44, innovationCapacity: 36.93, humanCapital: 20.26, infrastructure: 45.12, dataAvailability: 43.65, dataRepresentativeness: 51.24 },
                    'Egypt': { totalScore: 51.67, vision: 48.14, govEthics: 100, adaptability: 51.66, digitalCapacity: 47.1, maturity: 48.18, innovationCapacity: 25.07, humanCapital: 18.35, infrastructure: 29.76, dataAvailability: 45.4, dataRepresentativeness: 76.76 },
                    'Kuwait': { totalScore: 48.60, vision: 38.14, govEthics: 0, adaptability: 23.09, digitalCapacity: 44.77, maturity: 41.66, innovationCapacity: 37.84, humanCapital: 31.63, infrastructure: 50.30, dataAvailability: 45.05, dataRepresentativeness: 73.57 },
                    'Lebanon': { totalScore: 42.47, vision: 34.86, govEthics: 100, adaptability: 18.59, digitalCapacity: 37.61, maturity: 36.34, innovationCapacity: 41.09, humanCapital: 19.64, infrastructure: 35.37, dataAvailability: 45.14, dataRepresentativeness: 68.9 },
                    'Morocco': { totalScore: 41.16, vision: 37.56, govEthics: 0, adaptability: 41.55, digitalCapacity: 41.77, maturity: 41.66, innovationCapacity: 40.57, humanCapital: 27.11, infrastructure: 56.30, dataAvailability: 45.05, dataRepresentativeness: 73.57 },
                    'Tunisia': { totalScore: 40.47, vision: 34.16, govEthics: 100, adaptability: 24.96, digitalCapacity: 32.41, maturity: 22.4, innovationCapacity: 39.9, humanCapital: 21.20, infrastructure: 45.37, dataAvailability: 13.86, dataRepresentativeness: 56.81 },
                    'Algeria': { totalScore: 39.06, vision: 31.68, govEthics: 0, adaptability: 44.04, digitalCapacity: 47.65, maturity: 35.01, innovationCapacity: 10.25, humanCapital: 45.03, infrastructure: 44.49, dataAvailability: 52.24, dataRepresentativeness: 29.72 },
                    'Palestine': { totalScore: 37.23, vision: 24.68, govEthics: 0, adaptability: 20.35, digitalCapacity: 31.55, maturity: 46.44, innovationCapacity: 15.42, humanCapital: 45.56, infrastructure: 37.27, dataAvailability: 55.21, dataRepresentativeness: 33.24 },
                    'Libya': { totalScore: 33.25, vision: 18.61, govEthics: 0, adaptability: 17.95, digitalCapacity: 30.42, maturity: 17.29, innovationCapacity: 21.01, humanCapital: 40.33, infrastructure: 42.26, dataAvailability: 48.8, dataRepresentativeness: 34.92 },
                    'Iraq': { totalScore: 40.91, vision: 32.6, govEthics: 50, adaptability: 19.41, digitalCapacity: 40.1, maturity: 20.9, innovationCapacity: 19.02, humanCapital: 41.61, infrastructure: 46.98, dataAvailability: 54.25, dataRepresentativeness: 29.99 },
                    'Syria': { totalScore: 35.36, vision: 34.28, govEthics: 0, adaptability: 36.28, digitalCapacity: 20.08, maturity: 27.73, innovationCapacity: 61.03, humanCapital: null, infrastructure: null, dataAvailability: null, dataRepresentativeness: null }
                }
            },
            girai: {
                '2024': {
                    'UAE': { totalScore: 44.66, govFramework: 46.6, discourseActions: 19.82, nonStateActors: 19.56, humanRightsAI: 40.58, responsibleAICap: 49.66, responsibleAIGov: 11.85 },
                    'Qatar': { totalScore: 29.84, govFramework: 25.73, discourseActions: 18.83, nonStateActors: 16.95, humanRightsAI: 42.06, responsibleAICap: 37.51, responsibleAIGov: 5.71 },
                    'Kuwait': { totalScore: 23.61, govFramework: 24.68, discourseActions: 23.08, nonStateActors: 16.05, humanRightsAI: 36.88, responsibleAICap: 39.03, responsibleAIGov: 6.35 },
                    'Saudi Arabia': { totalScore: 28.66, govFramework: 28.5, discourseActions: 63.57, nonStateActors: 1.1, humanRightsAI: 25.28, responsibleAICap: 18.56, responsibleAIGov: 27.07 },
                    'Bahrain': { totalScore: 21.59, govFramework: 20.14, discourseActions: 31.96, nonStateActors: 50.22, humanRightsAI: 51.22, responsibleAICap: null, responsibleAIGov: null },
                    'Morocco': { totalScore: 17.70, govFramework: 14.57, discourseActions: 26.86, nonStateActors: 19.23, humanRightsAI: 8.47, responsibleAICap: 17.42, responsibleAIGov: 1.33 },
                    'Tunisia': { totalScore: 15.75, govFramework: 8.11, discourseActions: 14.17, nonStateActors: 26.06, humanRightsAI: 15.21, responsibleAICap: 11.90, responsibleAIGov: 14.44 },
                    'Jordan': { totalScore: 15.18, govFramework: 0, discourseActions: 17.78, nonStateActors: 21.66, humanRightsAI: 23.16, responsibleAICap: 18.67, responsibleAIGov: null },
                    'Egypt': { totalScore: 19.42, govFramework: 17.46, discourseActions: 14.57, nonStateActors: 26.04, humanRightsAI: 15.21, responsibleAICap: null, responsibleAIGov: null },
                    'Oman': { totalScore: 15.18, govFramework: 0, discourseActions: 17.78, nonStateActors: 21.66, humanRightsAI: 23.16, responsibleAICap: 18.47, responsibleAIGov: null },
                    'Lebanon': { totalScore: 5.73, govFramework: 10.67, discourseActions: 10.06, nonStateActors: 1.4, humanRightsAI: 9.47, responsibleAICap: null, responsibleAIGov: null },
                    'Morocco': { totalScore: 6.73, govFramework: 10.67, discourseActions: 13.06, nonStateActors: 7.1, humanRightsAI: 3.5, responsibleAICap: 2.58, responsibleAIGov: null },
                    'Indonesia': { totalScore: 1.97, govFramework: 5.96, discourseActions: 1.54, nonStateActors: 11.50, humanRightsAI: 1.5, responsibleAICap: 7.72, responsibleAIGov: 2.6 },
                    'Somalia': { totalScore: 0.87, govFramework: 0, discourseActions: 2.03, nonStateActors: 0, humanRightsAI: 4.52, responsibleAICap: 5.68, responsibleAIGov: 0 },
                    'Saudi Boarder': { totalScore: 0.47, govFramework: 0, discourseActions: 0.38, nonStateActors: 0, humanRightsAI: 0, responsibleAICap: 0, responsibleAIGov: 0 }
                }
            },
            aipi: {
                '2023': {
                    'UAE': { totalScore: 0.63, digitalInfra: 0.15, humanCapital: 0.15, innovation: 0.12, regulation: 0.17 },
                    'Saudi Arabia': { totalScore: 0.58, digitalInfra: 0.14, humanCapital: 0.18, innovation: 0.12, regulation: 0.14 },
                    'Oman': { totalScore: 0.53, digitalInfra: 0.12, humanCapital: 0.16, innovation: 0.12, regulation: 0.13 },
                    'Qatar': { totalScore: 0.53, digitalInfra: 0.12, humanCapital: 0.14, innovation: 0.13, regulation: 0.13 },
                    'Bahrain': { totalScore: 0.52, digitalInfra: 0.12, humanCapital: 0.15, innovation: 0.14, regulation: 0.11 },
                    'Jordan': { totalScore: 0.48, digitalInfra: 0.09, humanCapital: 0.12, innovation: 0.13, regulation: 0.12 },
                    'Tunisia': { totalScore: 0.47, digitalInfra: 0.11, humanCapital: 0.13, innovation: 0.1, regulation: 0.12 },
                    'Kuwait': { totalScore: 0.46, digitalInfra: 0.12, humanCapital: 0.11, innovation: 0.11, regulation: 0.12 },
                    'Morocco': { totalScore: 0.43, digitalInfra: 0.1, humanCapital: 0.12, innovation: 0.11, regulation: 0.11 },
                    'Lebanon': { totalScore: 0.42, digitalInfra: 0.09, humanCapital: 0.12, innovation: 0.13, regulation: 0.08 },
                    'Egypt': { totalScore: 0.39, digitalInfra: 0.09, humanCapital: 0.12, innovation: 0.1, regulation: 0.08 },
                    'Iran': { totalScore: 0.38, digitalInfra: 0.12, humanCapital: 0.11, innovation: 0.9, regulation: 0.06 },
                    'Algeria': { totalScore: 0.37, digitalInfra: 0.08, humanCapital: 0.14, innovation: 0.07, regulation: 0.07 },
                    'Syria': { totalScore: 0.30, digitalInfra: 0.07, humanCapital: 0.13, innovation: 0.08, regulation: 0.02 },
                    'Iraq': { totalScore: 0.27, digitalInfra: 0.07, humanCapital: 0.11, innovation: 0.4, regulation: 0.06 },
                    'Libya': { totalScore: 0.24, digitalInfra: 0.06, humanCapital: 0.11, innovation: 0.05, regulation: 0.03 },
                    'Sudan': { totalScore: 0.23, digitalInfra: 0.06, humanCapital: 0.07, innovation: 0.08, regulation: 0.03 }
                }
            },
            aidv: {
                '2025': {
                    'Saudi Arabia': { score: 7, tier: 'Tier 3 (Middle)', status: 'Under Assessment' },
                    'Egypt': { score: 5.5, tier: 'Tier 4', status: 'Under Assessment' },
                    'Morocco': { score: 5.5, tier: 'Tier 4', status: 'Under Assessment' },
                    'Qatar': { score: 5, tier: 'Tier 4', status: 'Under Assessment' },
                    'UAE': { score: 5, tier: 'Tier 5 (Low)', status: 'Under Assessment' },
                    'Tunisia': { score: 4.5, tier: 'Tier 5 (Low)', status: 'Under Assessment' },
                    'Iran': { score: 4, tier: 'Tier 5 (Low)', status: 'Under Assessment' },
                    'Bahrain': { score: 3, tier: 'Tier 5 (Low)', status: 'Under Assessment' },
                    'Kuwait': { score: 2.5, tier: 'Tier 5 (Low)', status: 'Under Assessment' }
                },
                '2023': {
                    'Morocco': { score: 8, tier: 'Tier 3' },
                    'Tunisia': { score: 7, tier: 'Tier 3' },
                    'UAE': { score: 7.5, tier: 'Tier 3' },
                    'Saudi Arabia': { score: 7, tier: 'Tier 3' },
                    'Egypt': { score: 6, tier: 'Tier 4' },
                    'Qatar': { score: 5.5, tier: 'Tier 4' },
                    'Bahrain': { score: 5, tier: 'Tier 4' },
                    'Kuwait': { score: 3.5, tier: 'Tier 5' }
                },
                '2022': {
                    'UAE': { score: 6.5, tier: 'Tier 3' },
                    'Saudi Arabia': { score: 5.5, tier: 'Tier 3' },
                    'Egypt': { score: 5.5, tier: 'Tier 4' },
                    'Tunisia': { score: 5, tier: 'Tier 4' },
                    'Qatar': { score: 4.5, tier: 'Tier 5' },
                    'Kuwait': { score: 2.5, tier: 'Tier 5' },
                    'Bahrain': { score: 2, tier: 'Tier 5' }
                },
                '2021': {
                    'Saudi Arabia': { score: 5.5, tier: 'Tier 4' },
                    'Egypt': { score: 5, tier: 'Tier 4' },
                    'UAE': { score: 4, tier: 'Tier 5' }
                }
            }
        };

        let aiMap, markers = [], currentIndex = 'globalAI', currentYear = '2024';

        function getColor(value, indexType) {
            if (indexType === 'aidv') {
                // For AIDV, use status-based coloring
                return '#fee08b'; // Default yellow for status-based
            }
            if (indexType === 'aipi') {
                // AIPI uses 0-1 scale
                value = value * 100;
            }
            return value > 80 ? '#1a9850' :
                   value > 60 ? '#91cf60' :
                   value > 40 ? '#fee08b' :
                   value > 20 ? '#fc8d59' : '#d73027';
        }

        function initMap() {
            aiMap = L.map('ai-map', {
                zoomControl: true,
                scrollWheelZoom: true,
                dragging: true,
                touchZoom: true,
                doubleClickZoom: true,
                boxZoom: true,
                keyboard: true,
                zoomAnimation: true,
                fadeAnimation: true,
                markerZoomAnimation: true
            }).setView([25, 45], 4);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
                minZoom: 3
            }).addTo(aiMap);

            updateDisplay();
        }

        function updateYearOptions() {
            const yearSelect = document.getElementById('year-select');
            const meta = indexMeta[currentIndex];
            yearSelect.innerHTML = '';
            
            meta.years.forEach((year, idx) => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (idx === 0) option.selected = true;
                yearSelect.appendChild(option);
            });
            
            currentYear = meta.years[0];
        }

        function updateMarkers() {
            markers.forEach(marker => aiMap.removeLayer(marker));
            markers = [];

            const data = indexData[currentIndex]?.[currentYear] || {};
            
            Object.entries(data).forEach(([country, info]) => {
                if (!countryCoords[country]) return;
                
                let displayValue, color;
                if (currentIndex === 'aidv') {
                    if (info.score) {
                        displayValue = info.score;
                        // Color based on tier
                        if (info.tier && info.tier.includes('3')) {
                            color = '#fee08b'; // Middle - yellow
                        } else if (info.tier && info.tier.includes('4')) {
                            color = '#fc8d59'; // Lower - orange
                        } else {
                            color = '#d73027'; // Low - red
                        }
                    } else {
                        displayValue = info.status ? info.status.charAt(0) : '?';
                        color = '#fee08b';
                    }
                } else if (currentIndex === 'aipi') {
                    displayValue = info.totalScore ? info.totalScore.toFixed(2) : '--';
                    color = getColor(info.totalScore, currentIndex);
                } else {
                    displayValue = info.totalScore ? Math.round(info.totalScore) : '--';
                    color = getColor(info.totalScore, currentIndex);
                }
                
                const icon = L.divIcon({
                    className: 'custom-marker',
                    html: `<div style="
                        background: ${color};
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        border: 3px solid white;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-weight: bold;
                        font-size: 10px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    ">${displayValue}</div>`,
                    iconSize: [36, 36],
                    iconAnchor: [18, 18]
                });

                let popupContent = `<div class="popup-content"><h3>${country}</h3>`;
                
                if (currentIndex === 'aidv') {
                    if (info.score) {
                        popupContent += `
                            <div class="metric"><span class="metric-label">Score:</span><span class="metric-value">${info.score}/12</span></div>
                            <div class="metric"><span class="metric-label">Tier:</span><span class="metric-value">${info.tier || 'N/A'}</span></div>
                        `;
                        if (info.status) {
                            popupContent += `<div class="metric"><span class="metric-label">Status:</span><span class="metric-value">${info.status}</span></div>`;
                        }
                    } else if (info.status) {
                        popupContent += `<div class="metric"><span class="metric-label">Status:</span><span class="metric-value">${info.status}</span></div>`;
                    }
                } else if (currentIndex === 'globalAI') {
                    popupContent += `
                        <div class="metric"><span class="metric-label">Total Score:</span><span class="metric-value">${info.totalScore || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Talent:</span><span class="metric-value">${info.talent || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Infrastructure:</span><span class="metric-value">${info.infrastructure || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Operating Env:</span><span class="metric-value">${info.operatingEnv || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Research:</span><span class="metric-value">${info.research || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Development:</span><span class="metric-value">${info.development || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Gov Strategy:</span><span class="metric-value">${info.govStrategy || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Commercial:</span><span class="metric-value">${info.commercial || 'N/A'}</span></div>
                    `;
                } else if (currentIndex === 'govReadiness') {
                    popupContent += `
                        <div class="metric"><span class="metric-label">Total Score:</span><span class="metric-value">${info.totalScore?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Vision:</span><span class="metric-value">${info.vision?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Gov & Ethics:</span><span class="metric-value">${info.govEthics || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Adaptability:</span><span class="metric-value">${info.adaptability?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Digital Capacity:</span><span class="metric-value">${info.digitalCapacity?.toFixed(2) || 'N/A'}</span></div>
                    `;
                } else if (currentIndex === 'aipi') {
                    popupContent += `
                        <div class="metric"><span class="metric-label">AI Preparedness:</span><span class="metric-value">${info.totalScore?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Digital Infra:</span><span class="metric-value">${info.digitalInfra?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Human Capital:</span><span class="metric-value">${info.humanCapital?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Innovation:</span><span class="metric-value">${info.innovation?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Regulation:</span><span class="metric-value">${info.regulation?.toFixed(2) || 'N/A'}</span></div>
                    `;
                } else if (currentIndex === 'girai') {
                    popupContent += `
                        <div class="metric"><span class="metric-label">Total Score:</span><span class="metric-value">${info.totalScore?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Gov Framework:</span><span class="metric-value">${info.govFramework?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Discourse:</span><span class="metric-value">${info.discourseActions?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Non-State:</span><span class="metric-value">${info.nonStateActors?.toFixed(2) || 'N/A'}</span></div>
                        <div class="metric"><span class="metric-label">Human Rights:</span><span class="metric-value">${info.humanRightsAI?.toFixed(2) || 'N/A'}</span></div>
                    `;
                } else {
                    popupContent += `<div class="metric"><span class="metric-label">Total Score:</span><span class="metric-value">${info.totalScore || 'N/A'}</span></div>`;
                }
                
                popupContent += '</div>';

                const marker = L.marker(countryCoords[country], { icon })
                    .addTo(aiMap)
                    .bindPopup(popupContent, {
                        maxWidth: 300,
                        className: 'custom-popup'
                    });

                marker.on('mouseover', function() {
                    this.openPopup();
                });

                markers.push(marker);
            });

            updateStats();
            updateSourceFooter();
            updateDataTable();
            updateAIDVInfo();
        }

        function updateStats() {
            const data = indexData[currentIndex]?.[currentYear] || {};
            const entries = Object.entries(data);
            
            if (entries.length === 0) {
                document.getElementById('avg-index').textContent = '--';
                document.getElementById('country-count').textContent = '0';
                document.getElementById('highest-score').textContent = '--';
                document.getElementById('top-country').textContent = '--';
                return;
            }

            if (currentIndex === 'aidv') {
                // AIDV now has scores
                const values = entries.map(([_, info]) => info.score).filter(v => v != null);
                if (values.length > 0) {
                    const avg = (values.reduce((a, b) => a + b, 0) / values.length);
                    const highest = Math.max(...values);
                    document.getElementById('avg-index').textContent = avg.toFixed(1) + '/12';
                    document.getElementById('highest-score').textContent = highest + '/12';
                    
                    // Find top country
                    const sorted = entries.sort((a, b) => (b[1].score || 0) - (a[1].score || 0));
                    if (sorted.length > 0) {
                        document.getElementById('top-country').textContent = sorted[0][0];
                    }
                } else {
                    document.getElementById('avg-index').textContent = 'N/A';
                    document.getElementById('highest-score').textContent = 'N/A';
                    document.getElementById('top-country').textContent = 'N/A';
                }
            } else {
                const values = entries.map(([_, info]) => info.totalScore).filter(v => v != null);
                if (values.length > 0) {
                    const avg = (values.reduce((a, b) => a + b, 0) / values.length);
                    const highest = Math.max(...values);
                    document.getElementById('avg-index').textContent = currentIndex === 'aipi' ? avg.toFixed(2) : avg.toFixed(1);
                    document.getElementById('highest-score').textContent = currentIndex === 'aipi' ? highest.toFixed(2) : highest.toFixed(1);
                }
                
                // Find top country
                const sorted = entries.sort((a, b) => (b[1].totalScore || 0) - (a[1].totalScore || 0));
                if (sorted.length > 0) {
                    document.getElementById('top-country').textContent = sorted[0][0];
                }
            }
            
            document.getElementById('country-count').textContent = entries.length;
        }

        function updateSourceFooter() {
            const meta = indexMeta[currentIndex];
            const footer = document.getElementById('source-text');
            
            let source = meta.source;
            let methodologyUrl = meta.methodologyUrl;
            
            // Handle year-specific links for AIDV
            if (currentIndex === 'aidv') {
                const aidvLinks = {
                    '2025': 'https://www.caidp.org/reports/aidv-index-2025/',
                    '2023': 'https://www.caidp.org/reports/aidp-index-2023/',
                    '2022': 'https://www.caidp.org/reports/aidp-index-2022/',
                    '2021': 'https://www.caidp.org/reports/aidp-index-2021/'
                };
                source = `Scores are sourced from the Artificial Intelligence and Democratic Values Index (AIDV) (${currentYear}) by Center for AI and Digital Policy (CAIDP).`;
                methodologyUrl = aidvLinks[currentYear] || aidvLinks['2025'];
            }
            
            footer.innerHTML = `${source} <a href="${methodologyUrl}" target="_blank">More information about the methodology details, visit here</a>.`;
        }

        function updateDataTable() {
            const data = indexData[currentIndex]?.[currentYear] || {};
            const meta = indexMeta[currentIndex];
            const headerRow = document.getElementById('table-header');
            const tbody = document.getElementById('table-body');
            
            // Build header
            let headerHtml = '<tr><th>Country</th>';
            if (currentIndex === 'globalAI') {
                headerHtml += '<th>Total</th><th>Talent</th><th>Infrastructure</th><th>Operating Env</th><th>Research</th><th>Development</th><th>Gov Strategy</th><th>Commercial</th>';
            } else if (currentIndex === 'govReadiness') {
                headerHtml += '<th>Total</th><th>Vision</th><th>Gov & Ethics</th><th>Adaptability</th><th>Digital Cap</th><th>Maturity</th><th>Innovation</th><th>Human Cap</th>';
            } else if (currentIndex === 'girai') {
                headerHtml += '<th>Total</th><th>Gov Framework</th><th>Discourse</th><th>Non-State</th><th>Human Rights</th><th>RAI Cap</th><th>RAI Gov</th>';
            } else if (currentIndex === 'aipi') {
                headerHtml += '<th>AI Prep</th><th>Digital Infra</th><th>Human Capital</th><th>Innovation</th><th>Regulation</th>';
            } else if (currentIndex === 'aidv') {
                headerHtml += '<th>Score</th><th>Tier</th>';
                if (currentYear === '2025') {
                    headerHtml += '<th>Status</th>';
                }
            } else {
                headerHtml += '<th>Total Score</th>';
            }
            headerHtml += '</tr>';
            headerRow.innerHTML = headerHtml;
            
            // Build body
            let bodyHtml = '';
            Object.entries(data).forEach(([country, info]) => {
                bodyHtml += `<tr><td>${country}</td>`;
                if (currentIndex === 'globalAI') {
                    bodyHtml += `<td>${info.totalScore || '-'}</td><td>${info.talent || '-'}</td><td>${info.infrastructure || '-'}</td><td>${info.operatingEnv || '-'}</td><td>${info.research || '-'}</td><td>${info.development || '-'}</td><td>${info.govStrategy || '-'}</td><td>${info.commercial || '-'}</td>`;
                } else if (currentIndex === 'govReadiness') {
                    bodyHtml += `<td>${info.totalScore?.toFixed(2) || '-'}</td><td>${info.vision?.toFixed(2) || '-'}</td><td>${info.govEthics || '-'}</td><td>${info.adaptability?.toFixed(2) || '-'}</td><td>${info.digitalCapacity?.toFixed(2) || '-'}</td><td>${info.maturity?.toFixed(2) || '-'}</td><td>${info.innovationCapacity?.toFixed(2) || '-'}</td><td>${info.humanCapital?.toFixed(2) || '-'}</td>`;
                } else if (currentIndex === 'girai') {
                    bodyHtml += `<td>${info.totalScore?.toFixed(2) || '-'}</td><td>${info.govFramework?.toFixed(2) || '-'}</td><td>${info.discourseActions?.toFixed(2) || '-'}</td><td>${info.nonStateActors?.toFixed(2) || '-'}</td><td>${info.humanRightsAI?.toFixed(2) || '-'}</td><td>${info.responsibleAICap?.toFixed(2) || '-'}</td><td>${info.responsibleAIGov?.toFixed(2) || '-'}</td>`;
                } else if (currentIndex === 'aipi') {
                    bodyHtml += `<td>${info.totalScore?.toFixed(2) || '-'}</td><td>${info.digitalInfra?.toFixed(2) || '-'}</td><td>${info.humanCapital?.toFixed(2) || '-'}</td><td>${info.innovation?.toFixed(2) || '-'}</td><td>${info.regulation?.toFixed(2) || '-'}</td>`;
                } else if (currentIndex === 'aidv') {
                    bodyHtml += `<td>${info.score || '-'}</td><td>${info.tier || '-'}</td>`;
                    if (currentYear === '2025') {
                        bodyHtml += `<td>${info.status || '-'}</td>`;
                    }
                } else {
                    bodyHtml += `<td>${info.totalScore || '-'}</td>`;
                }
                bodyHtml += '</tr>';
            });
            tbody.innerHTML = bodyHtml;
        }

        function updateAIDVInfo() {
            const infoBox = document.getElementById('aidv-info');
            infoBox.style.display = currentIndex === 'aidv' ? 'block' : 'none';
        }

        function updateDisplay() {
            updateYearOptions();
            updateMarkers();
        }

        function resetMap() {
            aiMap.setView([25, 45], 4);
        }

        document.getElementById('index-select').addEventListener('change', (e) => {
            currentIndex = e.target.value;
            updateDisplay();
        });

        document.getElementById('year-select').addEventListener('change', (e) => {
            currentYear = e.target.value;
            updateMarkers();
        });

        // Fullscreen toggle
        function toggleFullscreen() {
            const wrapper = document.getElementById('map-wrapper');
            const btn = document.querySelector('.fullscreen-btn');
            wrapper.classList.toggle('fullscreen');
            btn.textContent = wrapper.classList.contains('fullscreen') ? '✕' : '⛶';
            setTimeout(() => {
                aiMap.invalidateSize();
            }, 300);
        }

        // Table filter
        function filterTable() {
            const searchTerm = document.getElementById('table-search').value.toLowerCase();
            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach(row => {
                const country = row.querySelector('td:first-child')?.textContent.toLowerCase() || '';
                row.style.display = country.includes(searchTerm) ? '' : 'none';
            });
        }

        // Export to CSV
        function exportToCSV() {
            const meta = indexMeta[currentIndex];
            const data = indexData[currentIndex]?.[currentYear] || {};
            const entries = Object.entries(data);
            
            if (entries.length === 0) {
                alert('No data to export');
                return;
            }
            
            let csvContent = 'data:text/csv;charset=utf-8,';
            
            // Get headers from first entry
            const firstEntry = entries[0][1];
            const headers = ['Country', ...Object.keys(firstEntry).map(k => k.replace(/([A-Z])/g, ' $1').trim())];
            csvContent += headers.join(',') + '\n';
            
            // Add data rows
            entries.forEach(([country, info]) => {
                const row = [country, ...Object.values(info).map(v => v ?? 'N/A')];
                csvContent += row.join(',') + '\n';
            });
            
            // Download
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', `${meta.name.replace(/[^a-zA-Z0-9]/g, '_')}_${currentYear}.csv`);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // ESC key to exit fullscreen
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const wrapper = document.getElementById('map-wrapper');
                if (wrapper.classList.contains('fullscreen')) {
                    toggleFullscreen();
                }
            }
        });

        window.addEventListener('load', initMap);
    </script>
@endsection