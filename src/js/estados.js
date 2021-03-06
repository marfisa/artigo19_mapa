var estadosEstatisticas;

var estadosPontos = {
	'AC' : [new GLatLng(-9.882275, -66.621094), new GLatLng(-8.895926, -68.939209), new GLatLng(-8.113615, -70.422363), new GLatLng(-7.602108, -72.685547), new GLatLng(-7.089990, -73.817139), new GLatLng(-7.558547, -73.981934), new GLatLng(-9.015302, -72.949219), new GLatLng(-9.373193, -73.201904), new GLatLng(-9.535749, -72.301025), new GLatLng(-9.979671, -72.136230), new GLatLng(-9.979671, -71.257324), new GLatLng(-9.449062, -70.554199), new GLatLng(-11.005904, -70.620117), new GLatLng(-11.005904, -68.796387), new GLatLng(-11.146066, -68.686523), new GLatLng(-10.941192, -68.225098), new GLatLng(-10.639014, -68.027344), new GLatLng(-10.703792, -67.686768), new GLatLng(-9.882275, -66.621094)],
	'AL' : [new GLatLng(-8.847079, -37.754517), new GLatLng(-9.281043, -38.182983), new GLatLng(-9.432806, -38.122559), new GLatLng(-9.801091, -37.315063), new GLatLng(-10.444598, -36.441650), new GLatLng(-9.243093, -35.370483), new GLatLng(-8.906780, -35.145264), new GLatLng(-8.819939, -35.540771), new GLatLng(-8.863362, -35.903320), new GLatLng(-9.107521, -36.287842), new GLatLng(-9.302728, -36.573486), new GLatLng(-9.270201, -36.743774), new GLatLng(-9.275622, -36.897583), new GLatLng(-9.373193, -36.952515), new GLatLng(-8.847079, -37.754517)],
	'AM' : [new GLatLng(0.285643, -58.908691), new GLatLng(0.285643, -60.007324), new GLatLng(-0.769020, -60.666504), new GLatLng(-0.439449, -61.083984), new GLatLng(-0.637194, -61.523438), new GLatLng(-1.384143, -61.655273), new GLatLng(-0.659165, -62.578125), new GLatLng(-0.263671, -62.182617), new GLatLng(2.021065, -62.797852), new GLatLng(2.262595, -63.413086), new GLatLng(0.769020, -65.566406), new GLatLng(1.164471, -65.720215), new GLatLng(0.790990, -66.159668), new GLatLng(1.208406, -66.884766), new GLatLng(2.350415, -67.500000), new GLatLng(1.735574, -68.291016), new GLatLng(1.757537, -69.807129), new GLatLng(1.142502, -69.873047), new GLatLng(1.032659, -69.257812), new GLatLng(0.615223, -69.191895), new GLatLng(0.571280, -70.004883), new GLatLng(-0.241699, -70.048828), new GLatLng(-1.076597, -69.411621), new GLatLng(-4.280680, -69.960938), new GLatLng(-4.412137, -71.608887), new GLatLng(-5.156599, -72.839355), new GLatLng(-7.100893, -73.784180), new GLatLng(-8.102739, -70.356445), new GLatLng(-9.774025, -66.774902), new GLatLng(-9.362353, -66.445312), new GLatLng(-9.470736, -65.764160), new GLatLng(-8.863362, -64.204102), new GLatLng(-7.906912, -63.654785), new GLatLng(-7.885147, -62.907715), new GLatLng(-8.711359, -61.589355), new GLatLng(-8.689639, -58.469238), new GLatLng(-7.209900, -58.183594), new GLatLng(-6.751896, -58.535156), new GLatLng(-2.306506, -56.381836), new GLatLng(-1.010690, -58.403320), new GLatLng(-0.329588, -58.908691), new GLatLng(0.285643, -58.908691)],
	'AP' : [new GLatLng(4.412137, -51.569824), new GLatLng(2.174771, -52.954102), new GLatLng(2.438229, -54.909668), new GLatLng(1.845384, -54.733887), new GLatLng(1.252342, -53.525391), new GLatLng(-0.966751, -52.119141), new GLatLng(0.834931, -50.075684), new GLatLng(1.735574, -49.899902), new GLatLng(2.240640, -50.712891), new GLatLng(4.149201, -51.262207), new GLatLng(4.412137, -51.569824)],
	'BA' : [new GLatLng(-18.307596, -39.666138), new GLatLng(-17.968283, -40.215454), new GLatLng(-17.785305, -40.138550), new GLatLng(-17.434511, -40.517578), new GLatLng(-16.920195, -40.512085), new GLatLng(-16.846605, -40.286865), new GLatLng(-16.056372, -39.852905), new GLatLng(-15.644197, -40.693359), new GLatLng(-15.702375, -41.286621), new GLatLng(-15.088036, -41.786499), new GLatLng(-15.109250, -42.138062), new GLatLng(-14.620794, -43.104858), new GLatLng(-14.673940, -43.851929), new GLatLng(-14.301647, -43.791504), new GLatLng(-14.227113, -44.417725), new GLatLng(-15.199386, -46.054688), new GLatLng(-11.566144, -46.334839), new GLatLng(-11.270000, -46.625977), new GLatLng(-10.131117, -45.626221), new GLatLng(-10.892648, -44.967041), new GLatLng(-10.006720, -43.698120), new GLatLng(-9.470736, -43.873901), new GLatLng(-9.248514, -43.450928), new GLatLng(-8.711359, -41.275635), new GLatLng(-9.167179, -40.671387), new GLatLng(-9.416548, -40.764771), new GLatLng(-9.367773, -40.407715), new GLatLng(-8.553862, -39.457397), new GLatLng(-9.064127, -38.314819), new GLatLng(-10.304110, -37.727051), new GLatLng(-10.682201, -37.847900), new GLatLng(-10.698394, -38.204956), new GLatLng(-10.876465, -38.232422), new GLatLng(-11.377724, -37.996216), new GLatLng(-11.463874, -37.364502), new GLatLng(-12.827870, -38.204956), new GLatLng(-13.261333, -38.963013), new GLatLng(-15.411319, -38.979492), new GLatLng(-15.813396, -38.880615), new GLatLng(-17.140791, -39.215698), new GLatLng(-17.675428, -39.127808), new GLatLng(-17.868975, -39.375000), new GLatLng(-18.224134, -39.649658), new GLatLng(-18.307596, -39.666138)],
	'CE' : [new GLatLng(-2.932069, -41.264648), new GLatLng(-3.381824, -41.462402), new GLatLng(-4.236856, -41.000977), new GLatLng(-4.510714, -41.220703), new GLatLng(-6.653695, -40.715332), new GLatLng(-6.806444, -40.363770), new GLatLng(-7.373362, -40.627441), new GLatLng(-7.275292, -39.594727), new GLatLng(-7.808963, -39.012451), new GLatLng(-7.286190, -38.562012), new GLatLng(-6.817353, -38.737793), new GLatLng(-6.085936, -38.452148), new GLatLng(-4.926779, -37.639160), new GLatLng(-4.806365, -37.254639), new GLatLng(-3.688855, -38.551025), new GLatLng(-2.778451, -40.089111), new GLatLng(-2.822344, -41.011963), new GLatLng(-2.932069, -41.264648)],
	'DF' : [new GLatLng(-15.496032, -48.186035), new GLatLng(-16.045813, -48.306885), new GLatLng(-16.035255, -47.373047), new GLatLng(-15.527791, -47.416992), new GLatLng(-15.496032, -48.186035)],
	'ES' : [new GLatLng(-20.231270, -41.737061), new GLatLng(-20.699600, -41.890862), new GLatLng(-21.115240, -41.654659), new GLatLng(-21.238180, -40.957031), new GLatLng(-19.746019, -40.012199), new GLatLng(-19.497660, -39.726559), new GLatLng(-18.333660, -39.682610), new GLatLng(-17.978729, -40.220940), new GLatLng(-17.916019, -40.572510), new GLatLng(-18.166731, -41.072380), new GLatLng(-18.401440, -41.110840), new GLatLng(-18.406651, -41.000969), new GLatLng(-19.025770, -41.006470), new GLatLng(-19.414789, -40.946041), new GLatLng(-20.267349, -41.374512), new GLatLng(-20.231270, -41.737061)],
	'GO' : [new GLatLng(-12.929615, -46.263428), new GLatLng(-13.239945, -47.449951), new GLatLng(-13.025966, -47.713623), new GLatLng(-13.421681, -47.691650), new GLatLng(-13.186468, -48.559570), new GLatLng(-12.779661, -48.867188), new GLatLng(-12.833226, -49.196777), new GLatLng(-13.239945, -49.372559), new GLatLng(-12.801088, -50.295410), new GLatLng(-15.019075, -51.141357), new GLatLng(-15.050906, -51.427002), new GLatLng(-17.193275, -53.239746), new GLatLng(-18.281519, -53.074951), new GLatLng(-18.344097, -52.756348), new GLatLng(-18.542116, -52.932129), new GLatLng(-19.414791, -50.899658), new GLatLng(-18.615013, -50.218506), new GLatLng(-18.458769, -49.515381), new GLatLng(-18.604601, -49.416504), new GLatLng(-18.281519, -49.075928), new GLatLng(-18.448347, -47.999268), new GLatLng(-18.051867, -47.318115), new GLatLng(-17.329664, -47.559814), new GLatLng(-16.951723, -47.219238), new GLatLng(-16.562492, -47.570801), new GLatLng(-16.056372, -47.340088), new GLatLng(-16.066929, -48.339844), new GLatLng(-15.464269, -48.229980), new GLatLng(-15.474857, -47.438965), new GLatLng(-15.982454, -47.373047), new GLatLng(-15.802825, -46.834717), new GLatLng(-14.987240, -46.889648), new GLatLng(-15.082732, -46.625977), new GLatLng(-14.668626, -46.483154), new GLatLng(-14.849231, -46.109619), new GLatLng(-12.929615, -46.263428)],
	'MA' : [new GLatLng(-1.230374, -45.988770), new GLatLng(-2.833317, -46.604004), new GLatLng(-4.587376, -47.614746), new GLatLng(-4.576425, -47.889404), new GLatLng(-5.101887, -48.482666), new GLatLng(-5.441022, -47.504883), new GLatLng(-6.337137, -47.351074), new GLatLng(-7.155400, -47.713623), new GLatLng(-8.026595, -47.021484), new GLatLng(-7.885147, -46.625977), new GLatLng(-7.961317, -46.450195), new GLatLng(-8.276727, -46.538086), new GLatLng(-8.331083, -46.801758), new GLatLng(-9.015302, -47.021484), new GLatLng(-10.087854, -46.373291), new GLatLng(-10.196000, -45.955811), new GLatLng(-8.809082, -45.944824), new GLatLng(-7.569437, -45.406494), new GLatLng(-7.242598, -44.549561), new GLatLng(-6.740986, -44.033203), new GLatLng(-6.762806, -43.088379), new GLatLng(-6.413566, -42.769775), new GLatLng(-6.031311, -43.066406), new GLatLng(-5.528511, -43.077393), new GLatLng(-5.156599, -42.780762), new GLatLng(-4.269724, -42.989502), new GLatLng(-3.458591, -42.495117), new GLatLng(-2.833317, -41.682129), new GLatLng(-2.262595, -43.714600), new GLatLng(-1.285293, -44.945068), new GLatLng(-1.230374, -45.988770)],
	'MG' : [new GLatLng(-20.024967, -50.987549), new GLatLng(-19.735683, -50.559082), new GLatLng(-19.963022, -49.383545), new GLatLng(-20.148785, -49.240723), new GLatLng(-19.963022, -47.493896), new GLatLng(-21.053743, -47.120361), new GLatLng(-21.637005, -46.614990), new GLatLng(-22.217920, -46.658936), new GLatLng(-22.370396, -46.428223), new GLatLng(-22.867317, -46.329346), new GLatLng(-22.411030, -45.142822), new GLatLng(-22.421185, -44.758301), new GLatLng(-22.116177, -43.945312), new GLatLng(-22.044912, -43.099365), new GLatLng(-21.688057, -42.297363), new GLatLng(-21.575720, -42.374268), new GLatLng(-20.930658, -42.121582), new GLatLng(-20.879343, -41.978760), new GLatLng(-20.468189, -41.781006), new GLatLng(-20.210655, -41.748047), new GLatLng(-20.262197, -41.385498), new GLatLng(-19.404430, -40.957031), new GLatLng(-19.041349, -41.022949), new GLatLng(-18.437925, -41.022949), new GLatLng(-18.427502, -41.143799), new GLatLng(-18.156290, -41.088867), new GLatLng(-17.905569, -40.583496), new GLatLng(-17.957832, -40.220947), new GLatLng(-17.790535, -40.155029), new GLatLng(-17.444992, -40.539551), new GLatLng(-16.909683, -40.528564), new GLatLng(-16.846605, -40.297852), new GLatLng(-16.077486, -39.869385), new GLatLng(-15.675932, -40.682373), new GLatLng(-15.718239, -41.297607), new GLatLng(-15.114553, -41.770020), new GLatLng(-15.125159, -42.143555), new GLatLng(-14.647368, -43.099365), new GLatLng(-14.689881, -43.879395), new GLatLng(-14.338904, -43.813477), new GLatLng(-14.253735, -44.406738), new GLatLng(-15.231190, -46.054688), new GLatLng(-14.891705, -46.043701), new GLatLng(-14.732386, -46.483154), new GLatLng(-15.114553, -46.614990), new GLatLng(-15.019075, -46.889648), new GLatLng(-15.823966, -46.823730), new GLatLng(-16.045813, -47.285156), new GLatLng(-16.551962, -47.548828), new GLatLng(-16.941216, -47.175293), new GLatLng(-17.340153, -47.537842), new GLatLng(-18.051867, -47.296143), new GLatLng(-18.479609, -47.977295), new GLatLng(-18.323240, -49.053955), new GLatLng(-18.656654, -49.405518), new GLatLng(-18.510866, -49.515381), new GLatLng(-18.625425, -50.174561), new GLatLng(-19.248922, -50.778809), new GLatLng(-19.663280, -51.031494), new GLatLng(-20.024967, -50.987549)],
	'MS' : [new GLatLng(-19.445873, -50.921631), new GLatLng(-18.552532, -52.965088), new GLatLng(-18.364952, -52.767334), new GLatLng(-18.291950, -53.096924), new GLatLng(-18.051867, -53.129883), new GLatLng(-17.916023, -53.953857), new GLatLng(-17.256235, -53.657227), new GLatLng(-17.664961, -54.338379), new GLatLng(-17.444992, -54.569092), new GLatLng(-17.612612, -55.151367), new GLatLng(-17.130293, -56.173096), new GLatLng(-17.319176, -56.744385), new GLatLng(-17.759150, -57.084961), new GLatLng(-17.759150, -57.689209), new GLatLng(-18.208481, -57.546387), new GLatLng(-19.756365, -58.128662), new GLatLng(-19.973349, -57.875977), new GLatLng(-20.128155, -58.128662), new GLatLng(-21.074249, -57.864990), new GLatLng(-22.044912, -57.974854), new GLatLng(-22.268764, -56.832275), new GLatLng(-22.095819, -56.491699), new GLatLng(-22.299261, -56.217041), new GLatLng(-22.400871, -55.733643), new GLatLng(-23.966175, -55.393066), new GLatLng(-23.865746, -54.667969), new GLatLng(-24.036430, -54.316406), new GLatLng(-22.471954, -52.954102), new GLatLng(-21.657429, -52.097168), new GLatLng(-20.612221, -51.646729), new GLatLng(-20.179724, -51.053467), new GLatLng(-19.642588, -51.053467), new GLatLng(-19.445873, -50.921631)],
	'MT' : [new GLatLng(-8.776511, -61.545410), new GLatLng(-11.092166, -61.479492), new GLatLng(-11.135287, -60.029297), new GLatLng(-12.297068, -59.919434), new GLatLng(-13.667338, -60.666504), new GLatLng(-15.008464, -60.227051), new GLatLng(-16.256866, -60.205078), new GLatLng(-16.320139, -58.293457), new GLatLng(-17.077789, -58.469238), new GLatLng(-17.748688, -57.722168), new GLatLng(-17.706827, -57.062988), new GLatLng(-17.287708, -56.799316), new GLatLng(-17.119793, -56.184082), new GLatLng(-17.623081, -55.107422), new GLatLng(-17.350637, -54.602051), new GLatLng(-17.602139, -54.338379), new GLatLng(-17.224758, -53.679199), new GLatLng(-17.853291, -53.920898), new GLatLng(-17.916023, -53.173828), new GLatLng(-17.224758, -53.239746), new GLatLng(-15.855674, -52.097168), new GLatLng(-15.029686, -51.459961), new GLatLng(-14.966013, -51.152344), new GLatLng(-12.382928, -50.185547), new GLatLng(-12.811801, -50.625000), new GLatLng(-10.703792, -50.625000), new GLatLng(-9.752370, -50.229492), new GLatLng(-9.318990, -56.755371), new GLatLng(-8.711359, -57.568359), new GLatLng(-7.231699, -58.161621), new GLatLng(-8.798225, -58.425293), new GLatLng(-8.776511, -61.545410)],
	'PA' : [new GLatLng(1.186439, -58.842773), new GLatLng(-0.285643, -58.864746), new GLatLng(-0.944781, -58.447266), new GLatLng(-2.306506, -56.337891), new GLatLng(-6.773716, -58.491211), new GLatLng(-7.253496, -58.073730), new GLatLng(-8.689639, -57.546387), new GLatLng(-9.275622, -56.755371), new GLatLng(-9.709057, -50.185547), new GLatLng(-8.776511, -49.570312), new GLatLng(-7.776309, -49.284668), new GLatLng(-7.623887, -49.394531), new GLatLng(-6.773716, -49.196777), new GLatLng(-6.577303, -48.713379), new GLatLng(-5.637853, -48.208008), new GLatLng(-5.287887, -48.735352), new GLatLng(-4.565474, -47.878418), new GLatLng(-4.565474, -47.636719), new GLatLng(-2.833317, -46.647949), new GLatLng(-1.164471, -46.054688), new GLatLng(0.703107, -50.207520), new GLatLng(-1.186439, -52.097168), new GLatLng(1.252342, -53.591309), new GLatLng(1.823423, -54.755859), new GLatLng(2.547988, -54.975586), new GLatLng(2.438229, -56.052246), new GLatLng(1.867345, -55.920410), new GLatLng(1.955187, -57.370605), new GLatLng(1.186439, -58.842773)],
	'PB' : [new GLatLng(-6.358975, -38.540039), new GLatLng(-6.773716, -38.715820), new GLatLng(-7.280741, -38.556519), new GLatLng(-7.574883, -38.765259), new GLatLng(-7.727322, -38.594971), new GLatLng(-7.808963, -38.111572), new GLatLng(-7.269843, -37.348022), new GLatLng(-7.460518, -36.985474), new GLatLng(-7.928675, -37.353516), new GLatLng(-8.276727, -37.018433), new GLatLng(-7.912353, -36.546021), new GLatLng(-7.776309, -35.925293), new GLatLng(-7.640220, -35.491333), new GLatLng(-7.351571, -35.255127), new GLatLng(-7.514981, -34.832153), new GLatLng(-7.095442, -34.832153), new GLatLng(-6.522730, -34.974976), new GLatLng(-6.309839, -36.386719), new GLatLng(-6.970049, -36.562500), new GLatLng(-6.615501, -37.507324), new GLatLng(-6.036773, -37.205200), new GLatLng(-6.500899, -38.166504), new GLatLng(-6.358975, -38.540039)],
	'PE' : [new GLatLng(-7.400600, -40.643921), new GLatLng(-8.135367, -40.605469), new GLatLng(-8.667918, -41.292114), new GLatLng(-9.161756, -40.649414), new GLatLng(-9.400291, -40.742798), new GLatLng(-9.351513, -40.424194), new GLatLng(-8.537565, -39.457397), new GLatLng(-9.053277, -38.292847), new GLatLng(-9.270201, -38.204956), new GLatLng(-8.830795, -37.765503), new GLatLng(-9.356933, -36.958008), new GLatLng(-9.264779, -36.914062), new GLatLng(-9.281043, -36.567993), new GLatLng(-8.841651, -35.930786), new GLatLng(-8.803654, -35.513306), new GLatLng(-8.879644, -35.145264), new GLatLng(-8.010276, -34.832153), new GLatLng(-7.536764, -34.832153), new GLatLng(-7.357019, -35.255127), new GLatLng(-7.640220, -35.485840), new GLatLng(-7.906912, -36.540527), new GLatLng(-8.276727, -37.018433), new GLatLng(-7.928675, -37.359009), new GLatLng(-7.460518, -36.996460), new GLatLng(-7.275292, -37.348022), new GLatLng(-7.819847, -38.133545), new GLatLng(-7.743651, -38.616943), new GLatLng(-7.553101, -38.787231), new GLatLng(-7.825289, -39.012451), new GLatLng(-7.291639, -39.600220), new GLatLng(-7.400600, -40.643921)],
	'PI' : [new GLatLng(-2.888180, -41.693115), new GLatLng(-3.425692, -42.484131), new GLatLng(-4.225900, -42.956543), new GLatLng(-5.156599, -42.725830), new GLatLng(-5.517575, -43.044434), new GLatLng(-6.031311, -43.077393), new GLatLng(-6.446318, -42.769775), new GLatLng(-6.795535, -43.099365), new GLatLng(-6.751896, -44.044189), new GLatLng(-7.253496, -44.549561), new GLatLng(-7.591218, -45.395508), new GLatLng(-8.787368, -45.933838), new GLatLng(-10.185187, -45.944824), new GLatLng(-10.109486, -45.615234), new GLatLng(-10.833306, -44.989014), new GLatLng(-10.012130, -43.725586), new GLatLng(-9.459899, -43.912354), new GLatLng(-8.657057, -41.308594), new GLatLng(-8.135367, -40.627441), new GLatLng(-7.427837, -40.671387), new GLatLng(-6.817353, -40.407715), new GLatLng(-6.664608, -40.748291), new GLatLng(-4.532618, -41.242676), new GLatLng(-4.225900, -41.044922), new GLatLng(-3.414725, -41.484375), new GLatLng(-2.964984, -41.275635), new GLatLng(-2.888180, -41.693115)],
	'PR' : [new GLatLng(-23.008965, -49.987793), new GLatLng(-22.563293, -52.976074), new GLatLng(-24.076559, -54.316406), new GLatLng(-25.611811, -54.547119), new GLatLng(-25.671236, -53.898926), new GLatLng(-26.175159, -53.701172), new GLatLng(-26.735800, -51.372070), new GLatLng(-26.185019, -51.097412), new GLatLng(-25.958044, -48.614502), new GLatLng(-25.244696, -48.153076), new GLatLng(-24.726875, -48.636475), new GLatLng(-24.457151, -49.273682), new GLatLng(-23.008965, -49.987793)],
	'RJ' : [new GLatLng(-22.441496, -44.725342), new GLatLng(-22.654572, -44.176025), new GLatLng(-22.847071, -44.560547), new GLatLng(-23.099943, -44.807739), new GLatLng(-23.322081, -44.719849), new GLatLng(-23.019075, -43.417969), new GLatLng(-22.968510, -42.044678), new GLatLng(-22.395794, -41.824951), new GLatLng(-21.988895, -40.973511), new GLatLng(-21.483742, -41.094360), new GLatLng(-21.268900, -40.951538), new GLatLng(-21.120375, -41.676636), new GLatLng(-20.725290, -41.885376), new GLatLng(-20.889608, -41.956787), new GLatLng(-20.940920, -42.105103), new GLatLng(-21.560392, -42.357788), new GLatLng(-21.693161, -42.280884), new GLatLng(-22.060186, -43.104858), new GLatLng(-22.126354, -43.939819), new GLatLng(-22.441496, -44.725342)],
	'RN' : [new GLatLng(-4.828260, -37.260132), new GLatLng(-4.910360, -37.633667), new GLatLng(-6.080473, -38.441162), new GLatLng(-6.337137, -38.551025), new GLatLng(-6.495441, -38.133545), new GLatLng(-6.020385, -37.183228), new GLatLng(-6.610044, -37.485352), new GLatLng(-6.948239, -36.567993), new GLatLng(-6.287999, -36.392212), new GLatLng(-6.500899, -34.980469), new GLatLng(-5.134715, -35.480347), new GLatLng(-5.047171, -36.760254), new GLatLng(-4.828260, -37.260132)],
	'RO' : [new GLatLng(-8.776511, -61.578369), new GLatLng(-7.972198, -62.874756), new GLatLng(-7.961317, -63.588867), new GLatLng(-8.939340, -64.226074), new GLatLng(-9.524914, -65.775146), new GLatLng(-9.362353, -66.412354), new GLatLng(-9.774025, -66.763916), new GLatLng(-9.871452, -66.632080), new GLatLng(-9.698228, -65.390625), new GLatLng(-11.038255, -65.291748), new GLatLng(-11.813588, -65.072021), new GLatLng(-12.468760, -64.302979), new GLatLng(-13.122280, -62.182617), new GLatLng(-13.475106, -61.820068), new GLatLng(-13.635310, -60.699463), new GLatLng(-12.297068, -59.974365), new GLatLng(-11.146066, -60.062256), new GLatLng(-11.113727, -61.501465), new GLatLng(-8.776511, -61.578369)],
	'RR' : [new GLatLng(4.762573, -60.776367), new GLatLng(4.105369, -62.160645), new GLatLng(3.951941, -63.940430), new GLatLng(4.302591, -64.841309), new GLatLng(2.438229, -63.918457), new GLatLng(2.043024, -62.775879), new GLatLng(-0.285643, -62.160645), new GLatLng(-0.593251, -62.534180), new GLatLng(-1.362176, -61.677246), new GLatLng(-0.615223, -61.545410), new GLatLng(-0.351560, -61.127930), new GLatLng(-0.703107, -60.688477), new GLatLng(0.329588, -60.029297), new GLatLng(0.307616, -58.930664), new GLatLng(1.274309, -58.886719), new GLatLng(1.428075, -59.260254), new GLatLng(1.889306, -59.721680), new GLatLng(2.262595, -59.743652), new GLatLng(2.416276, -59.875488), new GLatLng(3.074695, -59.985352), new GLatLng(4.017699, -59.567871), new GLatLng(4.434044, -59.787598), new GLatLng(4.521666, -60.139160), new GLatLng(5.134715, -60.029297), new GLatLng(5.266008, -60.688477), new GLatLng(4.762573, -60.776367)],
	'RS' : [new GLatLng(-27.156919, -53.865967), new GLatLng(-27.605671, -54.865723), new GLatLng(-30.259068, -57.634277), new GLatLng(-30.306503, -57.205811), new GLatLng(-30.116623, -57.052002), new GLatLng(-30.817347, -56.030273), new GLatLng(-31.099981, -55.986328), new GLatLng(-30.864510, -55.612793), new GLatLng(-31.914867, -54.085693), new GLatLng(-32.101189, -53.778076), new GLatLng(-32.463425, -53.569336), new GLatLng(-32.741081, -53.107910), new GLatLng(-33.109947, -53.503418), new GLatLng(-33.696922, -53.492432), new GLatLng(-33.751747, -53.360596), new GLatLng(-33.128349, -52.624512), new GLatLng(-32.231392, -52.196045), new GLatLng(-31.156408, -50.822754), new GLatLng(-30.401306, -50.306396), new GLatLng(-29.324720, -49.790039), new GLatLng(-29.276815, -50.163574), new GLatLng(-28.497662, -49.768066), new GLatLng(-28.430054, -50.581055), new GLatLng(-27.547241, -51.569824), new GLatLng(-27.537500, -51.855469), new GLatLng(-27.332735, -52.020264), new GLatLng(-27.156919, -53.865967)],
	'SC' : [new GLatLng(-26.214590, -53.624268), new GLatLng(-27.147144, -53.833008), new GLatLng(-27.313213, -52.020264), new GLatLng(-27.527758, -51.833496), new GLatLng(-27.518015, -51.558838), new GLatLng(-28.401066, -50.570068), new GLatLng(-28.497662, -49.735107), new GLatLng(-29.257648, -50.141602), new GLatLng(-29.315142, -49.724121), new GLatLng(-28.729130, -49.097900), new GLatLng(-28.613459, -48.834229), new GLatLng(-27.974998, -48.581543), new GLatLng(-26.980829, -48.603516), new GLatLng(-26.519735, -48.680420), new GLatLng(-26.283566, -48.515625), new GLatLng(-25.977798, -48.603516), new GLatLng(-26.214590, -51.075439), new GLatLng(-26.755421, -51.361084), new GLatLng(-26.214590, -53.624268)],
	'SE' : [new GLatLng(-9.470736, -38.089600), new GLatLng(-10.282491, -37.705078), new GLatLng(-10.682201, -37.814941), new GLatLng(-10.736175, -38.199463), new GLatLng(-10.865676, -38.221436), new GLatLng(-11.340025, -38.001709), new GLatLng(-11.458491, -37.364502), new GLatLng(-10.725381, -36.892090), new GLatLng(-10.477009, -36.441650), new GLatLng(-9.795678, -37.320557), new GLatLng(-9.470736, -38.089600)],
	'SP' : [new GLatLng(-22.512556, -52.954102), new GLatLng(-22.877439, -50.690918), new GLatLng(-22.978624, -49.987793), new GLatLng(-24.427145, -49.262695), new GLatLng(-24.726875, -48.625488), new GLatLng(-25.185059, -48.142090), new GLatLng(-24.447149, -47.131348), new GLatLng(-23.986254, -46.450195), new GLatLng(-23.765238, -45.944824), new GLatLng(-23.825550, -45.329590), new GLatLng(-23.402765, -45.153809), new GLatLng(-23.382599, -44.714355), new GLatLng(-23.099943, -44.824219), new GLatLng(-22.836946, -44.538574), new GLatLng(-22.654572, -44.208984), new GLatLng(-22.451649, -44.758301), new GLatLng(-22.431339, -45.153809), new GLatLng(-22.674847, -45.747070), new GLatLng(-22.877439, -46.318359), new GLatLng(-22.390715, -46.450195), new GLatLng(-22.228090, -46.647949), new GLatLng(-21.698265, -46.604004), new GLatLng(-21.084499, -47.109375), new GLatLng(-19.993998, -47.504883), new GLatLng(-20.200346, -49.240723), new GLatLng(-19.993998, -49.394531), new GLatLng(-19.766705, -50.515137), new GLatLng(-20.632784, -51.613770), new GLatLng(-21.677849, -52.075195), new GLatLng(-22.512556, -52.954102)],
	'TO' : [new GLatLng(-5.353521, -48.702393), new GLatLng(-5.626919, -48.142090), new GLatLng(-6.620957, -48.702393), new GLatLng(-6.915521, -49.196777), new GLatLng(-7.569437, -49.394531), new GLatLng(-7.798079, -49.185791), new GLatLng(-8.754795, -49.515381), new GLatLng(-9.719886, -50.196533), new GLatLng(-10.671404, -50.603027), new GLatLng(-12.747516, -50.603027), new GLatLng(-12.758232, -50.295410), new GLatLng(-13.218556, -49.383545), new GLatLng(-12.801088, -49.196777), new GLatLng(-12.747516, -48.834229), new GLatLng(-13.132979, -48.581543), new GLatLng(-13.389620, -47.713623), new GLatLng(-12.972442, -47.768555), new GLatLng(-13.229251, -47.438965), new GLatLng(-12.929615, -46.241455), new GLatLng(-11.566144, -46.351318), new GLatLng(-11.275387, -46.669922), new GLatLng(-10.250060, -45.780029), new GLatLng(-10.141932, -46.395264), new GLatLng(-9.015302, -47.043457), new GLatLng(-8.331083, -46.812744), new GLatLng(-8.276727, -46.527100), new GLatLng(-7.983078, -46.472168), new GLatLng(-7.896030, -46.647949), new GLatLng(-8.059230, -47.032471), new GLatLng(-7.177201, -47.735596), new GLatLng(-6.369894, -47.362061), new GLatLng(-5.473832, -47.537842), new GLatLng(-5.156599, -48.460693), new GLatLng(-5.353521, -48.702393)]
};

var relacoes = [
	{
		'nome':'Rádios por milhão de habitantes',
		'cor':'#009900',
		'dividendo':'pon',
		'divisor':'pop',
		'divisor_divisor':1000000
	},
	{
		'nome':'Rádios por município',
		'cor':'#990000',
		'dividendo':'pon',
		'divisor':'mun',
		'divisor_divisor':1
	},
	{
		'nome':'Número total de rádios',
		'cor':'#000099',
		'dividendo':'pon',
		'divisor':1,
		'divisor_divisor':1
	}
];

var rel_global = 0;

/******************************************/

function criaPoligonoEstado(estado, relacao, opacidade)
{
	// gambiarra para resolver problema no IE quando o valor do sexto
	// parâmetro passado para o GPolygon é maior que 1
	if (opacidade > 2.5) {
		opacidade = 2.5;
	}
	
	var polyEstado = new GPolygon(estadosPontos[estado], "#000000", 4, 0.15, relacoes[relacao].cor, opacidade*0.40);
	GEvent.addListener(polyEstado, "click", function(latlng)
		{
			htmlBalao = '<div class="balao_uf">';
			htmlBalao += '<h2>'+estadosEstatisticas[estado].nom+'</h2>';
			htmlBalao += '<p><strong>População:</strong> ' + estadosEstatisticas[estado].pop + '</p>';
			htmlBalao += '<p><strong>Municípios: </strong>' + estadosEstatisticas[estado].mun + '</p>';
			htmlBalao += '<p><strong style="color:' + relacoes[relacao].cor + '">' + relacoes[relacao].nome + ': </strong>' + Math.round(estadosEstatisticas[estado].rel*Math.pow(10,4))/Math.pow(10,4) + '</p>';
			htmlBalao += '</div>';
	
			if (!boolProcuraRealizada) {
				map.openInfoWindow(latlng, htmlBalao);
			}
		}
	);

	return polyEstado;
}

/******************************************/

function removeShapesEstados()
{
	if ($('legendaMapa')) $('legendaMapa').remove();
}

/******************************************/

function criaShapesEstados(relacaoInicial)
{

	innerHTML = '<div class="titulo">Legenda dos estados</div><ul>';
	for (i=0; i<3; i++)
		innerHTML += '<li><a href="javascript:desenhaEstados('+ i + ');" style="color:' + relacoes[i].cor + '"><div class="cor" style="background-color:' + relacoes[i].cor + '"></div>' + relacoes[i].nome + '</a></li>';
	innerHTML += '</ul>';

	var idLegenda = new Element('div', {'id':'legendaMapa'})
		.setHTML(innerHTML)
		.injectAfter($('map'));

	atualizaPosicaoLegenda();
	desenhaEstados(relacaoInicial);
}

/******************************************/

function atualizaPosicaoLegenda()
{
	if ($('legendaMapa'))
	{
		var gMapCoords = $('map').getCoordinates();
		var legCoords = $('legendaMapa').getCoordinates();

		$('legendaMapa').setStyles(
			{
				'left':gMapCoords.left + 10,
				'top':gMapCoords.bottom - legCoords.height - 50
			}
		);
	}
}

/******************************************/

function desenhaEstados(relacao)
{
	legArray = $$('div#legendaMapa a')
	legArray.removeClass('selecionado');
	legArray[relacao].addClass('selecionado');

	rel_global = relacao;
	map.clearOverlays();

	new Ajax('includes/AjaxEstadosEstatisticas.php', {method: 'get', onComplete:
		function(jsonResult)
		{
			relacao = rel_global;
			estadosEstatisticas = eval("(" + jsonResult + ")");
			relacaoMax = 0;
	
			for (estado in estadosPontos) {
				if ($type(relacoes[relacao].divisor) == 'string') {
					divisor = estadosEstatisticas[estado][relacoes[relacao].divisor];
				} else {
					divisor = relacoes[relacao].divisor;
				}
		
				estadosEstatisticas[estado].rel = estadosEstatisticas[estado][relacoes[relacao].dividendo]/(divisor/relacoes[relacao].divisor_divisor);
		
				if (estadosEstatisticas[estado].rel > relacaoMax && estado != 'DF') {
					relacaoMax = estadosEstatisticas[estado].rel;
				}
			}
	
			for (estado in estadosPontos) {
				var polyEstado = criaPoligonoEstado(estado, relacao, estadosEstatisticas[estado].rel/relacaoMax);
				map.addOverlay(polyEstado);
			}
		}
	}).request();
}

/******************************************/
